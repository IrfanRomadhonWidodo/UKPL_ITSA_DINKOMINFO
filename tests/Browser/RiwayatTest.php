<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Formulir;

class RiwayatTest extends DuskTestCase
{
    /**
     * Test user can view riwayat list.
     */
    public function test_user_can_view_riwayat_list(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/riwayat')
                ->assertPathIs('/riwayat')
                ->assertSee('Riwayat');
        });
    }

    /**
     * Test riwayat page displays formulir list.
     */
    public function test_riwayat_page_displays_formulir_list(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/riwayat')
                ->waitFor('table', 10)
                ->assertVisible('table');
        });
    }

    /**
     * Test user can view riwayat detail.
     */
    public function test_user_can_view_riwayat_detail(): void
    {
        $admin = User::where('role', 'admin')->first();
        $formulir = Formulir::first();

        if (!$formulir) {
            $this->markTestSkipped('No formulir data available');
        }

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/riwayat/' . $formulir->id)
                ->assertSee($formulir->nama_aplikasi)
                ->assertSee('Detail');
        });
    }

    /**
     * Test riwayat detail shows formulir information.
     */
    public function test_riwayat_detail_shows_formulir_information(): void
    {
        $admin = User::where('role', 'admin')->first();
        $formulir = Formulir::first();

        if (!$formulir) {
            $this->markTestSkipped('No formulir data available');
        }

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/riwayat/' . $formulir->id)
                ->assertSee($formulir->nama_aplikasi)
                ->assertSee($formulir->domain_aplikasi);
        });
    }

    /**
     * Test user can filter riwayat by status.
     */
    public function test_user_can_filter_riwayat_by_status(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/riwayat')
                ->waitFor('select[name="status"]', 5)
                ->select('select[name="status"]', 'diproses')
                ->press('Filter')
                ->pause(1000)
                ->assertQueryStringHas('status', 'diproses');
        });
    }

    /**
     * Test riwayat shows status badge.
     */
    public function test_riwayat_shows_status_badge(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/riwayat')
                ->waitFor('table', 10)
                ->assertPresent('.badge, .status, [class*="status"]');
        });
    }
}
