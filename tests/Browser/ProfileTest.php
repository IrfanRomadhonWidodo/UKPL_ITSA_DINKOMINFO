<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_user_can_view_profile(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/profile')
                ->assertPathIs('/profile')
                ->assertSee('Profil')
                ->assertSee($user->name)
                ->assertSee($user->email);
        });
    }

    public function test_profile_page_shows_update_form(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/profile')
                ->assertVisible('input[name="name"]')
                ->assertVisible('input[name="email"]');
        });
    }

    public function test_user_can_update_profile_name(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();
        $newName = 'Updated Name Dusk';

        $this->browse(function (Browser $browser) use ($user, $newName) {
            $browser->loginAs($user)
                ->visit('/profile')
                ->clear('input[name="name"]')
                ->type('input[name="name"]', $newName)
                ->press('Simpan')
                ->waitForText('Profil berhasil diperbarui', 5)
                ->assertSee('Profil berhasil diperbarui');
        });

        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => $newName]);
    }

    public function test_profile_shows_password_update_section(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/profile')
                ->assertSee('Ubah Kata Sandi')
                ->assertVisible('input[name="current_password"]')
                ->assertVisible('input[name="password"]')
                ->assertVisible('input[name="password_confirmation"]');
        });
    }

    public function test_user_can_change_password(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/profile')
                ->scrollIntoView('input[name="current_password"]')
                ->type('input[name="current_password"]', 'user123')
                ->type('input[name="password"]', 'newpassword123')
                ->type('input[name="password_confirmation"]', 'newpassword123')
                ->press('Ubah Password')
                ->waitForText('Password berhasil diubah', 5)
                ->assertSee('Password berhasil diubah');
        });
    }

    public function test_user_cannot_change_password_with_wrong_current_password(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/profile')
                ->scrollIntoView('input[name="current_password"]')
                ->type('input[name="current_password"]', 'wrongpassword')
                ->type('input[name="password"]', 'newpassword123')
                ->type('input[name="password_confirmation"]', 'newpassword123')
                ->press('Ubah Password')
                ->waitFor('.text-red-600', 5)
                ->assertSee('Password lama tidak sesuai');
        });
    }
}
