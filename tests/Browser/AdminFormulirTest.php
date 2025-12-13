<?php

namespace Tests\Browser;

use App\Models\Formulir;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Str;

class AdminFormulirTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_admin_can_view_formulir_list(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/formulir')
                ->assertPathIs('/admin/formulir')
                ->assertSee('Manajemen Formulir');
        });
    }

    public function test_formulir_list_shows_data(): void
    {
        $admin = User::where('role', 'admin')->first();
        $formulir = Formulir::first();

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->loginAs($admin)
                ->visit('/admin/formulir')
                ->type('search', substr($formulir->nama_aplikasi, 0, 5))
                ->press('Cari')
                ->waitForText($formulir->nama_aplikasi)
                ->assertSee($formulir->nama_aplikasi);
        });
    }

    public function test_admin_can_view_formulir_detail(): void
    {
        $admin = User::where('role', 'admin')->first();
        $formulir = Formulir::first();

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->loginAs($admin)
                ->visit('/admin/formulir')
                ->type('search', substr($formulir->nama_aplikasi, 0, 5))
                ->press('Cari')
                ->waitForText($formulir->nama_aplikasi)
                ->click("button[onclick=\"openModal('viewFormulirModal{$formulir->id}')\"]")
                ->waitFor("#viewFormulirModal{$formulir->id}", 5)
                ->with("#viewFormulirModal{$formulir->id}", function ($modal) use ($formulir) {
                    $modal->assertSee('Detail Formulir')
                        ->assertSee($formulir->nama_aplikasi);
                });
        });
    }

    public function test_admin_can_update_formulir_status(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Find a 'diproses' formulir to reply to
        $formulir = Formulir::where('status', 'diproses')->first();

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->loginAs($admin)
                ->visit('/admin/formulir')
                ->type('search', substr($formulir->nama_aplikasi, 0, 5))
                ->press('Cari')
                ->waitForText($formulir->nama_aplikasi)
                ->click("button[onclick=\"openModal('replyFormulirModal{$formulir->id}')\"]")
                ->waitFor("#replyFormulirModal{$formulir->id}", 5)
                ->with("#replyFormulirModal{$formulir->id}", function ($modal) {
                    $modal->type('balasan_admin', 'Balasan dari admin')
                        ->press('Kirim Balasan');
                })
                ->waitForLocation('/admin/formulir')
                ->assertSee('Berhasil');
        });

        $this->assertDatabaseHas('formulir', [
            'id' => $formulir->id,
            'balasan_admin' => 'Balasan dari admin'
        ]);
    }

    /**
     * Test admin can search formulir
     */
    public function test_admin_can_search_formulir(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Use the specific unique formulir from seeder
        $uniqueFormulir = Formulir::where('nama_aplikasi', 'Aplikasi Siap Hasil')->first();
        // Use another random one as negative text
        $otherFormulir = Formulir::where('id', '!=', $uniqueFormulir->id)->first();

        $this->browse(function (Browser $browser) use ($admin, $uniqueFormulir, $otherFormulir) {
            $browser->loginAs($admin)
                ->visit('/admin/formulir')
                ->type('search', 'Siap Hasil')
                ->press('Cari')
                ->waitForText('Aplikasi Siap Hasil')
                ->assertSee('Aplikasi Siap Hasil')
                ->assertDontSee($otherFormulir->nama_aplikasi);
        });
    }

    /**
     * Test admin can filter formulir by status
     */
    public function test_admin_can_filter_formulir_by_status(): void
    {
        $admin = User::where('role', 'admin')->first();

        $formulirSelesai = Formulir::where('status', 'selesai')->first(); // "Aplikasi Siap Hasil"
        $formulirDiproses = Formulir::where('status', 'diproses')->first();

        $this->browse(function (Browser $browser) use ($admin, $formulirSelesai, $formulirDiproses) {
            $browser->loginAs($admin)
                ->visit('/admin/formulir')
                ->select('status', 'selesai')
                ->press('Cari')
                ->waitForText($formulirSelesai->nama_aplikasi)
                ->assertSee($formulirSelesai->nama_aplikasi)
                ->assertDontSee($formulirDiproses->nama_aplikasi);
        });
    }

    public function test_admin_can_delete_formulir(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Pick a 'diproses' one to delete
        $formulir = Formulir::where('status', 'diproses')->first();

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->loginAs($admin)
                ->visit('/admin/formulir')
                ->type('search', substr($formulir->nama_aplikasi, 0, 5))
                ->press('Cari')
                ->waitForText($formulir->nama_aplikasi)
                ->click("button[onclick=\"deleteFormulir({$formulir->id})\"]")
                ->waitFor('.swal2-container', 5)
                ->click('.swal2-confirm')
                ->waitUntilMissing('#delete-form-' . $formulir->id);
        });

        $this->assertDatabaseMissing('formulir', [
            'id' => $formulir->id,
        ]);
    }
}
