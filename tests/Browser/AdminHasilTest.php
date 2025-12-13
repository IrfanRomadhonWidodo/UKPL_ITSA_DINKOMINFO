<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Hasil;
use App\Models\Formulir;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminHasilTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(); // Runs DatabaseSeeder
    }

    /**
     * Test admin can view hasil list.
     */
    public function test_admin_can_view_hasil_list(): void
    {
        $admin = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/hasil')
                ->assertPathIs('/admin/hasil')
                ->assertSee('Hasil ITSA');
        });
    }

    /**
     * Test hasil list shows data table.
     */
    public function test_hasil_list_shows_data_table(): void
    {
        $admin = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/hasil')
                ->waitFor('table', 10)
                ->assertVisible('table');
        });
    }

    /**
     * Test admin can create hasil.
     */
    public function test_admin_can_create_hasil(): void
    {
        $admin = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();

        // Use the specific formulir created in FormulirSeeder for this test
        $formulir = Formulir::where('nama_aplikasi', 'Aplikasi Siap Hasil')->firstOrFail();

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->loginAs($admin)
                ->visit('/admin/hasil')
                ->click('button[onclick*="createHasilModal"], a[href*="hasil/create"]')
                ->waitFor('#createHasilModal, .modal, form', 5)
                ->whenAvailable('.modal, form', function ($modal) use ($formulir) {
                    $modal->select('select[name="formulir_id"]', $formulir->id)
                        ->type('textarea[name="deskripsi"]', 'Hasil ITSA menunjukkan sistem telah memenuhi standar keamanan.')
                        ->type('input[name="tautan"]', 'https://example.com/hasil/test')
                        ->press('Simpan Hasil');
                })
                ->waitForText('berhasil', 10)
                ->assertSee('berhasil');
        });

        $this->assertDatabaseHas('hasil_itsa', [
            'formulir_id' => $formulir->id,
        ]);
    }

    /**
     * Test admin can view hasil detail.
     */
    public function test_admin_can_view_hasil_detail(): void
    {
        $admin = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();

        $hasil = Hasil::whereHas('formulir', function ($q) {
            $q->where('nama_aplikasi', 'SIMPEG');
        })->firstOrFail();

        $this->browse(function (Browser $browser) use ($admin, $hasil) {
            $browser->loginAs($admin)
                ->visit('/admin/hasil')

                // isolate row
                ->type('search', 'SIMPEG')
                ->press('Cari')
                ->waitForText('SIMPEG', 5)

                // ✅ modal exists in DOM (meski hidden)
                // Click using the new ID
                ->click('#btn-view-' . $hasil->id)
                ->waitFor('#viewHasilModal' . $hasil->id . ', .modal', 5)
                ->assertSee($hasil->deskripsi);
        });
    }

    /**
     * Test admin can edit hasil.
     */
    public function test_admin_can_edit_hasil(): void
    {
        $admin = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();

        // Use another seeded hasil (e.g., E-OFFICE)
        $hasil = Hasil::whereHas('formulir', function ($q) {
            $q->where('nama_aplikasi', 'E-OFFICE');
        })->firstOrFail();

        $newDeskripsi = 'Deskripsi hasil ITSA yang diperbarui untuk testing.';

        $this->browse(function (Browser $browser) use ($admin, $hasil, $newDeskripsi) {
            $browser->loginAs($admin)
                ->visit('/admin/hasil')
                // Search to isolate
                ->type('input[name="search"]', 'E-OFFICE')
                ->press('Cari')
                ->waitForText('E-OFFICE', 5)
                ->waitFor('#btn-edit-' . $hasil->id, 5)

                ->click('#btn-edit-' . $hasil->id)
                ->waitFor('#editHasilModal' . $hasil->id . ', .modal', 5)
                ->whenAvailable('#editHasilModal' . $hasil->id, function ($modal) use ($newDeskripsi) {
                    $modal->clear('textarea[name="deskripsi"]')
                        ->type('textarea[name="deskripsi"]', $newDeskripsi)
                        ->press('Simpan Perubahan');
                })
                ->waitForText('berhasil', 10)
                ->assertSee('berhasil');
        });

        $this->assertDatabaseHas('hasil_itsa', [
            'id' => $hasil->id,
            'deskripsi' => $newDeskripsi,
        ]);
    }

    /**
     * Test admin can delete hasil.
     */
    public function test_admin_can_delete_hasil(): void
    {
        $admin = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();

        // Use LPSE for deletion
        $hasil = Hasil::whereHas('formulir', function ($q) {
            $q->where('nama_aplikasi', 'LPSE');
        })->firstOrFail();

        $hasilId = $hasil->id;

        $this->browse(function (Browser $browser) use ($admin, $hasilId) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/hasil')
                // Search to isolate
                ->type('input[name="search"]', 'LPSE')
                ->press('Cari')
                ->waitForText('LPSE', 5)

                ->script("document.getElementById('delete-form-{$hasilId}').submit();");
        });

        $this->assertDatabaseMissing('hasil_itsa', ['id' => $hasilId]);
    }

    /**
     * Test admin can search hasil.
     */
    public function test_admin_can_search_hasil(): void
    {
        $admin = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();

        // Use BAPENDA for search test
        $targetApp = 'BAPENDA';

        $this->browse(function (Browser $browser) use ($admin, $targetApp) {
            $browser->loginAs($admin)
                ->visit('/admin/hasil')
                ->waitFor('input[name="search"]', 5)
                ->type('input[name="search"]', $targetApp)
                ->press('Cari')
                ->waitForText($targetApp, 5)
                ->assertSee($targetApp);
        });
    }
}
