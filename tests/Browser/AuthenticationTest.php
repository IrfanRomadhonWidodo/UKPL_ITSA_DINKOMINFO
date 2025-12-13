<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthenticationTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }
    /**
     * Test login page displays correctly.
     */
    public function test_login_page_displays_correctly(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->logout() // Clear any existing session
                ->visit('/')
                ->assertSee('Login')
                ->assertSee('Email')
                ->assertSee('Kata Sandi')
                ->assertVisible('#email')
                ->assertVisible('#password')
                ->assertButtonEnabled('Masuk');
        });
    }

    /**
     * Test user can login with valid credentials.
     */
    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout() // Clear any existing session
                ->visit('/')
                ->type('#email', $user->email)
                ->type('#password', 'user123')
                ->press('Masuk')
                ->waitForLocation('/dashboard', 10)
                ->assertPathIs('/dashboard');
        });
    }

    /**
     * Test user cannot login with invalid credentials.
     */
    public function test_user_cannot_login_with_invalid_credentials(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout() // Clear any existing session
                ->visit('/')
                ->type('#email', $user->email)
                ->type('#password', 'wrong_password')
                ->press('Masuk')
                ->waitFor('.text-red-600', 10)
                ->assertSee('Email atau password salah.')
                ->assertPathIs('/');
        });
    }

    /**
     * Test user cannot login with processed status.
     */
    public function test_user_cannot_login_with_processed_status(): void
    {
        $user = User::where('status', 'diproses')->first();

        if (!$user) {
            $this->markTestSkipped('No user with status diproses found');
        }

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout() // Clear any existing session
                ->visit('/')
                ->type('#email', $user->email)
                ->type('#password', 'user123')
                ->press('Masuk')
                ->waitFor('.bg-yellow-100', 5)
                ->assertSee('Akun Anda sedang diproses')
                ->assertPathIs('/');
        });
    }

    /**
     * Test user cannot login with rejected status.
     */
    public function test_user_cannot_login_with_rejected_status(): void
    {
        $user = User::where('status', 'ditolak')->first();

        if (!$user) {
            $this->markTestSkipped('No user with status ditolak found');
        }

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout() // Clear any existing session
                ->visit('/')
                ->type('#email', $user->email)
                ->type('#password', 'user123')
                ->press('Masuk')
                ->waitFor('.bg-red-100', 5)
                ->assertSee('Akun Anda telah ditolak')
                ->assertPathIs('/');
        });
    }

    /**
     * Test register page displays correctly.
     */
    public function test_register_page_displays_correctly(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->logout() // Clear any existing session
                ->visit('/register')
                ->assertSee('Daftar')
                ->assertVisible('input[name="name"]')
                ->assertVisible('input[name="email"]')
                ->assertVisible('input[name="password"]')
                ->assertVisible('input[name="password_confirmation"]');
        });
    }

    /**
     * Test forgot password page displays correctly.
     */
    public function test_forgot_password_page_displays_correctly(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->logout() // Clear any existing session
                ->visit('/forgot-password')
                ->assertSee('Reset Password')
                ->assertVisible('input[name="email"]');
        });
    }

    /**
     * Test admin can login successfully.
     */
    public function test_admin_can_login_with_valid_credentials(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->logout() // Clear any existing session
                ->visit('/')
                ->type('#email', $admin->email)
                ->type('#password', 'irfan123')
                ->press('Masuk')
                ->waitForLocation('/dashboard', 10)
                ->assertPathIs('/dashboard');
        });
    }
}
