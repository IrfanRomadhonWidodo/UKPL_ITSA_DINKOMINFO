<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Formulir;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RiwayatTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Test user can view riwayat page with proper header.
     */
    public function test_user_can_view_riwayat_page(): void
    {
        $user = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/riwayat')
                ->waitUntilMissing('#loading-screen', 5)
                ->assertPathIs('/riwayat')
                ->assertSee('Riwayat Pengajuan ITSA')
                ->assertSee('Lihat status dan detail semua formulir yang telah Anda ajukan');
        });
    }

    /**
     * Test riwayat page displays stats cards.
     */
    public function test_riwayat_page_displays_stats_cards(): void
    {
        $user = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/riwayat')
                ->waitUntilMissing('#loading-screen', 5)
                ->assertSee('Total Pengajuan')
                ->assertSee('Diproses')
                ->assertSee('Perlu Revisi')
                ->assertSee('Selesai');
        });
    }

    /**
     * Test riwayat page displays formulir table.
     */
    public function test_riwayat_page_displays_formulir_table(): void
    {
        $user = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/riwayat')
                ->waitUntilMissing('#loading-screen', 5)
                ->waitFor('table', 10)
                ->assertVisible('table')
                ->assertSee('APLIKASI')
                ->assertSee('DOMAIN')
                ->assertSee('TANGGAL PENGAJUAN')
                ->assertSee('STATUS')
                ->assertSee('AKSI');
        });
    }

    /**
     * Test riwayat table displays seeded formulir data.
     */
    public function test_riwayat_table_shows_seeded_data(): void
    {
        $user = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();
        $formulir = Formulir::where('user_id', $user->id)->first();

        if (!$formulir) {
            $this->markTestSkipped('No formulir data available');
        }

        $this->browse(function (Browser $browser) use ($user, $formulir) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/riwayat')
                ->waitUntilMissing('#loading-screen', 5)
                ->waitFor('table', 10)
                ->assertSee($formulir->nama_aplikasi)
                ->assertSee($formulir->domain_aplikasi);
        });
    }

    /**
     * Test user can click detail button to open modal.
     */
    public function test_user_can_view_detail_modal(): void
    {
        $user = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();
        $formulir = Formulir::where('user_id', $user->id)->first();

        if (!$formulir) {
            $this->markTestSkipped('No formulir data available');
        }

        $this->browse(function (Browser $browser) use ($user, $formulir) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/riwayat')
                ->waitUntilMissing('#loading-screen', 5)
                ->waitFor('table', 10)
                ->click('button[onclick*="showDetail"]')
                ->waitFor('#detailModal', 5)
                ->assertVisible('#detailModal')
                ->assertSee('Detail Pengajuan')
                ->assertSee('Informasi Aplikasi')
                ->assertSee('Penanggung Jawab');
        });
    }

    /**
     * Test user can close detail modal.
     */
    public function test_user_can_close_detail_modal(): void
    {
        $user = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/riwayat')
                ->waitUntilMissing('#loading-screen', 5)
                ->waitFor('table', 10)
                ->click('button[onclick*="showDetail"]')
                ->waitFor('#detailModal', 5)
                ->assertVisible('#detailModal')
                ->click('button[onclick="closeModal()"]')
                ->pause(500)
                ->assertMissing('#detailModal:not(.hidden)');
        });
    }

    /**
     * Test edit button is visible for formulir with diproses status.
     */
    public function test_edit_button_visible_for_diproses_status(): void
    {
        $user = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();
        $formulir = Formulir::where('user_id', $user->id)->where('status', 'diproses')->first();

        if (!$formulir) {
            $this->markTestSkipped('No formulir with diproses status available');
        }

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/riwayat')
                ->waitUntilMissing('#loading-screen', 5)
                ->waitFor('table', 10)
                ->assertPresent('button[onclick*="showEditModal"]');
        });
    }

    /**
     * Test user can open edit modal for formulir with diproses status.
     */
    public function test_user_can_open_edit_modal(): void
    {
        $user = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();
        $formulir = Formulir::where('user_id', $user->id)->where('status', 'diproses')->first();

        if (!$formulir) {
            $this->markTestSkipped('No formulir with diproses status available');
        }

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/riwayat')
                ->waitUntilMissing('#loading-screen', 5)
                ->waitFor('table', 10)
                ->click('button[onclick*="showEditModal"]')
                ->waitFor('#editModal', 5)
                ->assertVisible('#editModal')
                ->assertSee('Edit Pengajuan')
                ->assertSee('Informasi Aplikasi')
                ->assertSee('Penanggung Jawab');
        });
    }

}
