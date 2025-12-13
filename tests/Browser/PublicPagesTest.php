<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Feedback;

class PublicPagesTest extends DuskTestCase
{
    /**
     * Test user can access faq page.
     */
    public function test_user_can_access_faq_page(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/faq')
                ->assertPathIs('/faq')
                ->assertSee('FAQ')
                ->assertSee('Pertanyaan');
        });
    }

    /**
     * Test faq page has expandable sections.
     */
    public function test_faq_page_has_expandable_sections(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/faq')
                ->waitFor('[class*="accordion"], [class*="faq"], details, .collapse', 5)
                ->assertPresent('[class*="accordion"], [class*="faq"], details, .collapse');
        });
    }

    /**
     * Test user can access panduan page.
     */
    public function test_user_can_access_panduan_page(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/panduan')
                ->assertPathIs('/panduan')
                ->assertSee('Panduan');
        });
    }

    /**
     * Test user can access download page.
     */
    public function test_user_can_access_download_page(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/download')
                ->assertPathIs('/download')
                ->assertSee('Download');
        });
    }

    /**
     * Test download page has download links.
     */
    public function test_download_page_has_download_links(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/download')
                ->assertPresent('a[href*="download"], button[onclick*="download"], .download-btn');
        });
    }

    /**
     * Test user can access kontak page.
     */
    public function test_user_can_access_kontak_page(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/kontak')
                ->assertPathIs('/kontak')
                ->assertSee('Kontak');
        });
    }

    /**
     * Test kontak page has feedback form.
     */
    public function test_kontak_page_has_feedback_form(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/kontak')
                ->assertVisible('select[name="subjek"]')
                ->assertVisible('textarea[name="pesan"]');
        });
    }

    /**
     * Test user can submit feedback via kontak.
     */
    public function test_user_can_submit_feedback_via_kontak(): void
    {
        $user = User::where('status', 'disetujui')->first();
        $message = 'Ini adalah pesan pengujian dari Dusk browser testing ' . time();

        $this->browse(function (Browser $browser) use ($user, $message) {
            $browser->loginAs($user)
                ->visit('/kontak')
                ->select('select[name="subjek"]', 'masalah_teknis')
                ->type('textarea[name="pesan"]', $message)
                ->press('Kirim')
                ->waitForText('berhasil', 10)
                ->assertSee('berhasil');
        });

        $this->assertDatabaseHas('feedbacks', [
            'user_id' => $user->id,
            'subjek' => 'masalah_teknis',
            'pesan' => $message
        ]);

        // Cleanup
        Feedback::where('pesan', $message)->delete();
    }

    /**
     * Test user can access profil itsa page.
     */
    public function test_user_can_access_profil_itsa_page(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/profil-itsa')
                ->assertPathIs('/profil-itsa')
                ->assertSee('ITSA');
        });
    }

    /**
     * Test user can access alur layanan page.
     */
    public function test_user_can_access_alur_layanan_page(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/alur-layanan')
                ->assertPathIs('/alur-layanan')
                ->assertSee('Alur Layanan');
        });
    }

    /**
     * Test alur layanan page shows steps.
     */
    public function test_alur_layanan_page_shows_steps(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/alur-layanan')
                ->assertPresent('[class*="step"], .timeline, ol, .alur');
        });
    }
}
