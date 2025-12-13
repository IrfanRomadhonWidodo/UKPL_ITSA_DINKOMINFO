<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserTest extends DuskTestCase
{
    /**
     * Test admin can view user list.
     */
    public function test_admin_can_view_user_list(): void
    {
        $admin = User::where('role', 'admin')->first();
        if (!$admin) {
            $admin = User::factory()->create(['role' => 'admin']);
        }

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
        $admin = User::where('role', 'admin')->first();

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
        $admin = User::where('role', 'admin')->first();
        $user = User::factory()->create([
            'name' => 'User To Edit',
            'role' => 'user',
            'status' => 'diproses'
        ]);

        $this->browse(function (Browser $browser) use ($admin, $user) {
            $browser->loginAs($admin)
                ->visit('/admin/users')
                ->waitForText('User To Edit')
                ->click("button[onclick=\"openModal('editUserModal{$user->id}')\"]")
                ->waitFor("#editUserModal{$user->id}")
                ->with("#editUserModal{$user->id}", function ($modal) {
                    $modal->type('name', 'User Edited')
                        ->select('status', 'disetujui')
                        ->press('Simpan Perubahan');
                })
                ->waitForText('Berhasil!')
                ->assertSee('Berhasil!');

            $this->assertDatabaseHas('users', [
                'id' => $user->id,
                'name' => 'User Edited',
                'status' => 'disetujui'
            ]);
        });
    }

    /**
     * Test admin can view user details.
     */
    public function test_admin_can_view_user_details(): void
    {
        $admin = User::where('role', 'admin')->first();
        $user = User::factory()->create([
            'name' => 'User Detail View',
            'email' => 'detailview@example.com'
        ]);

        $this->browse(function (Browser $browser) use ($admin, $user) {
            $browser->loginAs($admin)
                ->visit('/admin/users')
                ->waitForText('User Detail View')
                ->click("button[onclick=\"openModal('viewUserModal{$user->id}')\"]")
                ->waitFor("#viewUserModal{$user->id}")
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
        $admin = User::where('role', 'admin')->first();
        $user = User::factory()->create([
            'name' => 'User To Delete'
        ]);

        $this->browse(function (Browser $browser) use ($admin, $user) {
            $browser->loginAs($admin)
                ->visit('/admin/users')
                ->waitForText('User To Delete')
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
        $admin = User::where('role', 'admin')->first();
        User::factory()->create(['name' => 'SearchTargetUser']);
        User::factory()->create(['name' => 'OtherUser']);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/users')
                ->type('search', 'SearchTargetUser')
                ->press('Cari')
                ->waitForText('SearchTargetUser')
                ->assertSee('SearchTargetUser')
                ->assertDontSee('OtherUser');
        });
    }

    /**
     * Test admin can filter user by status.
     */
    public function test_admin_can_filter_user_by_status(): void
    {
        $admin = User::where('role', 'admin')->first();
        User::factory()->create(['name' => 'StatusTarget', 'status' => 'ditolak']);
        // Ensure we don't accidentally match admin or others

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/users')
                ->select('status', 'ditolak')
                ->press('Cari')
                ->waitForText('StatusTarget')
                ->assertSee('StatusTarget');
        });
    }
}
