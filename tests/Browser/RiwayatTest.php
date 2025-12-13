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

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_user_can_view_riwayat_list(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/riwayat')
                ->assertPathIs('/riwayat')
                ->assertSee('Riwayat');
        });
    }

    public function test_riwayat_page_displays_formulir_list(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/riwayat')
                ->waitFor('table', 10)
                ->assertVisible('table');
        });
    }

    public function test_user_can_view_riwayat_detail(): void
    {
        $admin = User::where('role', 'admin')->first();
        $formulir = Formulir::first();

        if (!$formulir) {
            $this->markTestSkipped('No formulir data available');
        }

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->loginAs($admin)
                ->visit('/riwayat/' . $formulir->id)
                ->assertSee($formulir->nama_aplikasi)
                ->assertSee('Detail');
        });
    }

    public function test_riwayat_detail_shows_formulir_information(): void
    {
        $admin = User::where('role', 'admin')->first();
        $formulir = Formulir::first();

        if (!$formulir) {
            $this->markTestSkipped('No formulir data available');
        }

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->loginAs($admin)
                ->visit('/riwayat/' . $formulir->id)
                ->assertSee($formulir->nama_aplikasi)
                ->assertSee($formulir->domain_aplikasi);
        });
    }

    public function test_user_can_filter_riwayat_by_status(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/riwayat')
                ->waitFor('select[name="status"]', 5)
                ->select('select[name="status"]', 'diproses')
                ->press('Filter')
                ->pause(1000)
                ->assertQueryStringHas('status', 'diproses');
        });
    }

    public function test_riwayat_shows_status_badge(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/riwayat')
                ->waitFor('table', 10)
                ->assertPresent('.badge, .status, [class*="status"]');
        });
    }
}
