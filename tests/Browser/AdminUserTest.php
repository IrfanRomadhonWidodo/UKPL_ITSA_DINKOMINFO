<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminUserTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }
    /**
     * Test admin can view user list.
     */
    public function test_admin_can_view_user_list(): void
    {
        $admin = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/users')
                ->assertPathIs('/admin/users')
                ->assertSee('Manajemen Pengguna')
                ->assertSee('Kelola akun pengguna');
        });
    }

    /**
     * Test admin can create new user.
     */
    public function test_admin_can_create_new_user(): void
    {
        $admin = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();


        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/users')
                ->click('button[onclick="openModal(\'createUserModal\')"]')
                ->waitFor('#createUserModal')
                ->with('#createUserModal', function ($modal) {
                    $modal->type('name', 'New Test User')
                        ->type('email', 'newtestuser@example.com')
                        ->type('password', 'password123')
                        ->type('password_confirmation', 'password123')
                        ->select('role', 'user')
                        ->select('status', 'diproses')
                        ->press('Buat Pengguna');
                })
                ->waitForText('Berhasil!')
                ->assertSee('Berhasil!');

            $this->assertDatabaseHas('users', ['email' => 'newtestuser@example.com']);
        });
    }

    /**
     * Test admin can edit user.
     */
    public function test_admin_can_edit_user(): void
    {
        $admin = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();
        // Use user_processing1 (Agung Saputra)
        $user = User::where('email', 'user_processing1@example.com')->first();

        $this->browse(function (Browser $browser) use ($admin, $user) {
            $browser->loginAs($admin)
                ->visit('/admin/users')

                // Search to ensure user is visible (handle pagination)
                ->type('search', $user->name)
                ->press('Cari')
                ->waitForText($user->name)

                // Wait for the specific user's edit button
                ->waitFor("button[onclick=\"openModal('editUserModal{$user->id}')\"]")

                // Force click using script to avoid interception
                ->script("document.querySelector(\"button[onclick=\\\"openModal('editUserModal{$user->id}')\\\"]\").click();");

            $browser->waitFor("#editUserModal{$user->id}")
                ->pause(500) // Small pause for animation

                ->with("#editUserModal{$user->id}", function ($modal) {
                    $modal->type('name', 'Agung Saputra Edited')
                        ->select('status', 'disetujui')
                        ->press('Simpan Perubahan');
                })

                // SweetAlert success
                ->waitForText('Berhasil!')
                ->assertSee('Berhasil!');
        });

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Agung Saputra Edited',
            'status' => 'disetujui',
        ]);
    }

    /**
     * Test admin can view user details.
     */
    public function test_admin_can_view_user_details(): void
    {
        $admin = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();
        $user = User::where('email', 'user_approved0@example.com')->first(); // Seta Pratama

        $this->browse(function (Browser $browser) use ($admin, $user) {
            $browser->loginAs($admin)
                ->visit('/admin/users')

                // Search to ensure user is visible (handle pagination)
                ->type('search', $user->name)
                ->press('Cari')
                ->waitForText($user->name)

                // Wait for view button and click securely
                ->waitFor("button[onclick=\"openModal('viewUserModal{$user->id}')\"]")
                ->script("document.querySelector(\"button[onclick=\\\"openModal('viewUserModal{$user->id}')\\\"]\").click();");

            $browser->waitFor("#viewUserModal{$user->id}")
                ->with("#viewUserModal{$user->id}", function ($modal) use ($user) {
                    $modal->assertSee('Detail Pengguna')
                        ->assertSee($user->name)
                        ->assertSee($user->email);
                });
        });
    }

    /**
     * Test admin can delete user.
     */
    public function test_admin_can_delete_user(): void
    {
        $admin = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();
        $user = User::where('email', 'user_rejected0@example.com')->first(); // Budi Santoso

        $this->browse(function (Browser $browser) use ($admin, $user) {
            $browser->loginAs($admin)
                ->visit('/admin/users')
                ->waitForText($user->name)
                ->click("button[onclick=\"deleteUser({$user->id})\"]")
                ->waitFor('.swal2-container')
                ->click('.swal2-confirm')
                ->waitUntilMissing('#delete-form-' . $user->id) // Wait for removal or reload
                ->assertPathIs('/admin/users');

            $this->assertDatabaseMissing('users', ['id' => $user->id]);
        });
    }

    /**
     * Test admin can search user.
     */
    public function test_admin_can_search_user(): void
    {
        $admin = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();
        $targetUser = User::where('email', 'user_approved0@example.com')->first(); // Seta Pratama
        $otherUser = User::where('email', 'user_rejected1@example.com')->first(); // Citra Melati

        $this->browse(function (Browser $browser) use ($admin, $targetUser, $otherUser) {
            $browser->loginAs($admin)
                ->visit('/admin/users')
                ->type('search', $targetUser->name)
                ->press('Cari')
                ->waitForText($targetUser->name)
                ->assertSee($targetUser->name)
                ->assertDontSee($otherUser->name);
        });
    }

    /**
     * Test admin can filter user by status.
     */
    public function test_admin_can_filter_user_by_status(): void
    {
        $admin = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();
        $targetUser = User::where('email', 'user_rejected1@example.com')->first(); // Citra Melati (Ditolak)

        $this->browse(function (Browser $browser) use ($admin, $targetUser) {
            $browser->loginAs($admin)
                ->visit('/admin/users')
                ->select('status', 'ditolak')
                ->press('Cari')
                ->waitForText($targetUser->name)
                ->assertSee($targetUser->name);
        });
    }
}
