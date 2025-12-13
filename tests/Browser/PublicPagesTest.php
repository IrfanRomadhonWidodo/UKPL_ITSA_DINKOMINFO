<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PublicPagesTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_user_can_access_faq_page(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/faq')
                ->assertPathIs('/faq')
                ->assertSee('FAQ')
                ->assertSee('Pertanyaan');
        });
    }

    public function test_faq_page_has_expandable_sections(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/faq')
                ->waitFor('[class*="accordion"], [class*="faq"], details, .collapse', 5)
                ->assertPresent('[class*="accordion"], [class*="faq"], details, .collapse');
        });
    }

    public function test_user_can_access_panduan_page(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/panduan')
                ->assertPathIs('/panduan')
                ->assertSee('Panduan');
        });
    }

    public function test_user_can_access_download_page(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/download')
                ->assertPathIs('/download')
                ->assertSee('Download');
        });
    }

    public function test_download_page_has_download_links(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/download')
                ->assertPresent('a[href*="download"], button[onclick*="download"], .download-btn');
        });
    }

    public function test_user_can_access_kontak_page(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/kontak')
                ->assertPathIs('/kontak')
                ->assertSee('Kontak');
        });
    }

    public function test_kontak_page_has_feedback_form(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/kontak')
                ->assertVisible('select[name="subjek"]')
                ->assertVisible('textarea[name="pesan"]');
        });
    }

    public function test_user_can_submit_feedback_via_kontak(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/kontak')
                ->select('select[name="subjek"]', 'masalah_teknis')
                ->type('textarea[name="pesan"]', 'Ini adalah pesan pengujian dari Dusk browser testing.')
                ->press('Kirim')
                ->waitForText('berhasil', 10)
                ->assertSee('berhasil');
        });

        $this->assertDatabaseHas('feedbacks', [
            'user_id' => $user->id,
            'subjek' => 'masalah_teknis',
        ]);
    }

    public function test_user_can_access_profil_itsa_page(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/profil-itsa')
                ->assertPathIs('/profil-itsa')
                ->assertSee('ITSA');
        });
    }

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

    public function test_alur_layanan_page_shows_steps(): void
    {
        $user = User::where('status', 'disetujui')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/alur-layanan')
                ->assertPresent('[class*="step"], .timeline, ol, .alur');
        });
    }
}
