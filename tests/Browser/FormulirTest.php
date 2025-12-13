<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Formulir;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FormulirTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_user_can_access_formulir_page(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/formulir')
                ->assertPathIs('/formulir')
                ->assertSee('Formulir');
        });
    }

    public function test_formulir_page_displays_required_fields(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/formulir')
                ->assertVisible('input[name="nama_aplikasi"]')
                ->assertVisible('input[name="domain_aplikasi"]')
                ->assertVisible('input[name="pejabat_nama"]')
                ->assertVisible('input[name="pejabat_nip"]');
        });
    }

    public function test_user_can_fill_formulir_step_one(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/formulir')
                ->waitFor('input[name="nama_aplikasi"]', 5)
                ->type('input[name="nama_aplikasi"]', 'Aplikasi Test Dusk')
                ->type('input[name="domain_aplikasi"]', 'testdusk.example.com')
                ->pause(500)
                ->assertInputValue('input[name="nama_aplikasi"]', 'Aplikasi Test Dusk');
        });
    }

    public function test_user_can_navigate_formulir_steps(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/formulir')
                ->waitFor('input[name="nama_aplikasi"]', 5)
                // Fill step 1
                ->type('input[name="nama_aplikasi"]', 'Aplikasi Test')
                ->type('input[name="domain_aplikasi"]', 'test.example.com')
                ->select('select[name="ip_jenis"]', 'public')
                ->type('input[name="ip_address"]', '192.168.1.100')
                // Click next step
                ->press('Selanjutnya')
                ->pause(1000)
                // Should be on step 2
                ->assertVisible('input[name="pejabat_nama"]');
        });
    }

    public function test_user_can_view_existing_formulir_data(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();
        $formulir = Formulir::where('user_id', $user->id)->first();

        if (!$formulir) {
            $this->markTestSkipped('No formulir data for this user');
        }

        $this->browse(function (Browser $browser) use ($user, $formulir) {
            $browser->loginAs($user)
                ->visit('/riwayat/' . $formulir->id)
                ->assertSee($formulir->nama_aplikasi);
        });
    }
}
