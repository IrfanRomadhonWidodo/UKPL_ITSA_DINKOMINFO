<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FeedbackTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Test user can view kontak page.
     */
    public function test_user_can_view_kontak_page(): void
    {
        $user = User::where('email', 'user_approved0@example.com')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/kontak')
                ->waitUntilMissing('#loading-screen', 5)
                ->assertPathIs('/kontak')
                ->assertSee('Kirim Feedback')
                ->assertSee('Kontak Informasi');
        });
    }

    /**
     * Test feedback form validation when submitting empty form.
     */
    public function test_feedback_form_validation_empty_submit(): void
    {
        $user = User::where('email', 'user_approved0@example.com')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/kontak')
                ->waitUntilMissing('#loading-screen', 5)
                ->scrollIntoView('button[type="submit"]')
                ->click('form[action*="feedback"] button[type="submit"]')
                ->waitForText('Silakan pilih subjek feedback', 5)
                ->assertSee('Silakan pilih subjek feedback');
        });
    }

    /**
     * Test user can successfully submit feedback with SweetAlert success.
     */
    public function test_user_can_submit_feedback_successfully(): void
    {
        $user = User::where('email', 'user_approved0@example.com')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/kontak')
                ->waitUntilMissing('#loading-screen', 5)
                ->radio('subjek', 'saran_pengembangan')
                ->type('pesan', 'Ini adalah feedback untuk testing dusk browser')
                ->scrollIntoView('button[type="submit"]')
                ->click('form[action*="feedback"] button[type="submit"]')
                ->waitFor('.swal2-popup', 5)
                ->assertSee('Berhasil')
                ->assertSee('Feedback berhasil dikirim');
        });

        // Verify feedback is saved in database
        $this->assertDatabaseHas('feedbacks', [
            'user_id' => $user->id,
            'subjek' => 'saran_pengembangan',
            'pesan' => 'Ini adalah feedback untuk testing dusk browser',
            'status' => 'diproses'
        ]);
    }
}
