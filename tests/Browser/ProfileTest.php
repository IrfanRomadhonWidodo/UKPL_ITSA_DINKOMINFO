<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class ProfileTest extends DuskTestCase
{
    /**
     * Test user can view profile.
     */
    public function test_user_can_view_profile(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/profile')
                ->assertPathIs('/profile')
                ->assertSee('Profil')
                ->assertSee($user->name)
                ->assertSee($user->email);
        });
    }

    /**
     * Test profile page shows update form.
     */
    public function test_profile_page_shows_update_form(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/profile')
                ->assertVisible('input[name="name"]')
                ->assertVisible('input[name="email"]');
        });
    }

    /**
     * Test user can update profile name.
     */
    public function test_user_can_update_profile_name(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();
        $newName = 'Updated Name Dusk';

        $this->browse(function (Browser $browser) use ($user, $newName) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/profile')
                ->clear('input[name="name"]')
                ->type('input[name="name"]', $newName)
                ->press('Simpan')
                ->waitForText('Profil berhasil diperbarui', 5)
                ->assertSee('Profil berhasil diperbarui');
        });

        // Revert name change or just check DB
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => $newName]);
    }

    /**
     * Test profile shows password update section.
     */
    public function test_profile_shows_password_update_section(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/profile')
                ->assertSee('Ubah Kata Sandi')
                ->assertVisible('input[name="current_password"]')
                ->assertVisible('input[name="password"]')
                ->assertVisible('input[name="password_confirmation"]');
        });
    }

    /**
     * Test user can change password.
     */
    public function test_user_can_change_password(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/profile')
                ->scrollIntoView('input[name="current_password"]')
                ->type('input[name="current_password"]', 'user123') // Assuming default password
                ->type('input[name="password"]', 'newpassword123')
                ->type('input[name="password_confirmation"]', 'newpassword123')
                ->press('Ubah Password')
                ->waitForText('Password berhasil diubah', 5)
                ->assertSee('Password berhasil diubah');
        });

        // Restore password for other tests? 
        // Or better: Use a specific user for password change tests to not break others?
        // Since we removed DatabaseMigrations, state PERSISTS. 
        // This means subsequent login tests with 'user123' might fail for THIS user.
        // I should revert the password immediately.

        $user->forceFill([
            'password' => '$2y$12$KjGg.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0' // Mock hash, or use Hash::make
        ])->save();
        // Actually simpler: Just update model directly
        $user->update(['password' => bcrypt('user123')]);
    }

    /**
     * Test user cannot change password with wrong current password.
     */
    public function test_user_cannot_change_password_with_wrong_current_password(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/profile')
                ->scrollIntoView('input[name="current_password"]')
                ->type('input[name="current_password"]', 'wrongpassword')
                ->type('input[name="password"]', 'newpassword123')
                ->type('input[name="password_confirmation"]', 'newpassword123')
                ->press('Ubah Password')
                ->waitFor('.text-red-600', 5) // Assuming error class
                ->assertSee('Password lama tidak sesuai'); // Check validation message
        });
    }
}
