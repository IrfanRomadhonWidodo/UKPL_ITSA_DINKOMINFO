<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;

class CrudFeatureTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_login_page_displays_correctly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Login')
                ->assertSee('Masuk untuk mengakses layanan ITSA Dinkominfo')
                ->assertSee('Email')
                ->assertSee('Kata Sandi')
                ->assertSee('Masuk')
                ->assertSee('Lupa kata sandi?')
                ->assertSee('Belum punya akun?')
                ->assertSee('Daftar di sini')
                ->assertVisible('#email')
                ->assertVisible('#password')
                ->assertVisible('input[type="checkbox"][name="remember"]')
                ->assertButtonEnabled('Masuk');
        });
    }

    public function test_user_cannot_login_with_processed_status()
    {
        // Buat user dengan status diproses
        $user = User::create([
            'name' => 'User Diproses',
            'email' => 'user_diproses@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'diproses',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/')
                ->type('#email', $user->email)
                ->type('#password', 'password')
                ->press('Masuk')
                ->waitFor('.bg-yellow-100', 5) // Tunggu muncul warning
                ->assertSee('Akun Anda sedang diproses. Silakan tunggu verifikasi administrator.')
                ->assertPathIs('/'); // Masih di halaman login
        });
    }

    public function test_user_cannot_login_with_rejected_status()
    {
        // Buat user dengan status ditolak
        $user = User::create([
            'name' => 'User Ditolak',
            'email' => 'user_ditolak@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'ditolak',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/')
                ->type('#email', $user->email)
                ->type('#password', 'password')
                ->press('Masuk')
                ->waitFor('.bg-red-100', 5) // Tunggu muncul error
                ->assertSee('Akun Anda telah ditolak. Silakan hubungi administrator.')
                ->assertPathIs('/'); // Masih di halaman login
        });
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        // Buat user
        $user = User::create([
            'name' => 'User Valid',
            'email' => 'user_valid@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'disetujui',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/')
                ->type('#email', $user->email)
                ->type('#password', 'wrong_password') // Password salah
                ->press('Masuk')
                ->waitFor('.text-red-600', 10) // Tunggu muncul error
                ->assertSee('Email atau password salah.')
                ->assertPathIs('/'); // Masih di halaman login
        });
    }

    public function test_auto_dismiss_alert_works()
    {
        // Buat user dengan status diproses untuk memunculkan alert
        $user = User::create([
            'name' => 'User Diproses',
            'email' => 'user_diproses@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'diproses',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/')
                ->type('#email', $user->email)
                ->type('#password', 'password')
                ->press('Masuk')
                ->waitFor('.bg-yellow-100', 5) // Tunggu muncul warning
                ->assertVisible('.bg-yellow-100') // Alert terlihat
                ->pause(6000) // Tunggu 6 detik (lebih dari 5 detik untuk auto dismiss)
                ->assertMissing('.bg-yellow-100'); // Alert harus hilang
        });
    }

    public function test_forgot_password_link_works()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Lupa kata sandi?')
                ->assertPathIs('/forgot-password'); // Asumsi route untuk forgot password
        });
    }

    public function test_register_link_works()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Daftar di sini')
                ->assertPathIs('/register'); // Asumsi route untuk register
        });
    }

    public function test_user_can_login_with_valid_credentials_and_approved_status()
    {
        $user = User::create([
            'name' => 'Admin Dusk',
            'email' => 'admin_dusk@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'disetujui',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/')
                ->type('#email', $user->email)
                ->type('#password', 'password')
                ->check('#remember_me')
                ->press('Masuk')
                ->waitForLocation('/dashboard', 10)
                ->pause(1000) 
                ->assertPathIs('/dashboard'); 
        });
    }

    public function test_admin_can_view_user_list()
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'disetujui',
        ]);

        User::factory()->create(['name' => 'User A', 'status' => 'diproses']);
        User::factory()->create(['name' => 'User B', 'status' => 'disetujui']);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/users')
                ->waitForText('Manajemen Pengguna', 10)
                ->assertSee('Manajemen Pengguna')
                ->assertSee('User A')
                ->assertSee('User B');
        });
    }

    public function test_admin_can_create_new_user()
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'disetujui',
        ]);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/users')
                ->click('button[onclick="openModal(\'createUserModal\')"]')
                ->waitFor('#createUserModal', 5) // Tunggu modal muncul
                ->whenAvailable('#createUserModal', function ($modal) {
                    $modal->type('input[name="name"]', 'Irfan Test')
                        ->type('input[name="email"]', 'irfan_test@example.com')
                        ->type('input[name="password"]', 'password')
                        ->type('input[name="password_confirmation"]', 'password')
                        ->select('select[name="role"]', 'user')
                        ->select('select[name="status"]', 'diproses')
                        ->press('Buat Pengguna');
                })
                ->waitForLocation('/admin/users', 5) // Tunggu redirect
                ->assertSee('User berhasil ditambahkan.');

            $this->assertDatabaseHas('users', ['email' => 'irfan_test@example.com']);
        });
    }

    public function test_admin_can_update_existing_user()
    {
        $admin = User::factory()->create([
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'disetujui',
        ]);
        $user = User::factory()->create(['name' => 'Old Name', 'status' => 'diproses']);

        $this->browse(function (Browser $browser) use ($admin, $user) {
            $browser->loginAs($admin)
                ->visit('/admin/users')
                ->click("button[onclick=\"openModal('editUserModal{$user->id}')\"]")
                ->waitFor("#editUserModal{$user->id}", 5) // Tunggu modal muncul
                ->whenAvailable("#editUserModal{$user->id}", function ($modal) {
                    $modal->type('input[name="name"]', 'Updated User')
                        ->select('select[name="status"]', 'disetujui')
                        ->press('Simpan Perubahan');
                })
                ->waitForLocation('/admin/users', 5) // Tunggu redirect
                ->assertSee('User berhasil diupdate.');

            $this->assertDatabaseHas('users', ['name' => 'Updated User', 'status' => 'disetujui']);
        });
    }

    public function test_admin_can_delete_user()
    {
        $admin = User::factory()->create([
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'disetujui',
        ]);
        $user = User::factory()->create(['name' => 'Delete Me']);

        $this->browse(function (Browser $browser) use ($admin, $user) {
            $browser->loginAs($admin)
                ->visit('/admin/users')
                ->assertSee('Delete Me')
                ->script("document.getElementById('delete-form-{$user->id}').submit();");

            $this->assertDatabaseMissing('users', ['id' => $user->id]);
        });
    }


    public function test_admin_can_search_user()
    {
        $admin = User::factory()->create([
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'disetujui',
        ]);
        User::factory()->create(['name' => 'CariSaya']);
        User::factory()->create(['name' => 'OrangLain']);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/users')
                ->type('input[name="search"]', 'CariSaya')
                ->press('Cari')
                ->waitForText('CariSaya', 5)
                ->assertSee('CariSaya')
                ->assertDontSee('OrangLain');
        });
    }

    public function test_admin_can_filter_user_by_status()
    {
        $admin = User::factory()->create([
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'disetujui',
        ]);
        User::factory()->create(['name' => 'UserDiproses', 'status' => 'diproses']);
        User::factory()->create(['name' => 'UserDitolak', 'status' => 'ditolak']);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/users')
                ->select('select[name="status"]', 'diproses')
                ->press('Cari')
                ->waitForText('UserDiproses', 5)
                ->assertSee('UserDiproses')
                ->assertDontSee('UserDitolak');
        });
    }

    public function test_admin_can_view_user_details()
    {
        $admin = User::factory()->create([
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'disetujui',
        ]);
        $user = User::factory()->create([
            'name' => 'Detail User',
            'email' => 'detail@example.com',
            'role' => 'user',
            'status' => 'diproses'
        ]);

        $this->browse(function (Browser $browser) use ($admin, $user) {
            $browser->loginAs($admin)
                ->visit('/admin/users')
                ->click("button[onclick=\"openModal('viewUserModal{$user->id}')\"]")
                ->waitFor("#viewUserModal{$user->id}", 5) // Tunggu modal muncul
                ->whenAvailable("#viewUserModal{$user->id}", function ($modal) use ($user) {
                    $modal->assertSee('Detail Pengguna')
                        ->assertSee($user->name)
                        ->assertSee($user->email)
                        ->assertSee('Informasi Pribadi')
                        ->assertSee('Informasi Akun')
                        ->assertSee('Informasi Waktu');
                });
        });
    }
}