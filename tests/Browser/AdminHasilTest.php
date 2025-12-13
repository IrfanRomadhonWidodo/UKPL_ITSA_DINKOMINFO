<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Hasil;
use App\Models\Formulir;

class AdminHasilTest extends DuskTestCase
{
    // NO DatabaseMigrations

    /**
     * Test admin can view hasil list.
     */
    public function test_admin_can_view_hasil_list(): void
    {
        $admin = User::where('role', 'admin')->first();

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
        $admin = User::where('role', 'admin')->first();

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
        $admin = User::where('role', 'admin')->first();

        // Create a dedicated formulir for this test
        $formulir = Formulir::factory()->create([
            'user_id' => $admin->id,
            'nama_aplikasi' => 'App For Hasil Creation'
        ]);

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->loginAs($admin)
                ->visit('/admin/hasil')
                ->click('button[onclick*="createHasilModal"], a[href*="hasil/create"]')
                ->waitFor('#createHasilModal, .modal, form', 5)
                ->whenAvailable('.modal, form', function ($modal) use ($formulir) {
                    $modal->select('select[name="formulir_id"]', $formulir->id)
                        ->type('textarea[name="deskripsi"]', 'Hasil ITSA menunjukkan sistem telah memenuhi standar keamanan.')
                        ->type('input[name="tautan"]', 'https://example.com/hasil/test')
                        ->press('Simpan');
                })
                ->waitForText('berhasil', 10)
                ->assertSee('berhasil');
        });

        $this->assertDatabaseHas('hasil_itsa', [
            'formulir_id' => $formulir->id,
        ]);

        // Cleanup results and formulir
        $hasil = Hasil::where('formulir_id', $formulir->id)->first();
        if ($hasil)
            $hasil->delete();
        $formulir->delete();
    }

    /**
     * Test admin can view hasil detail.
     */
    public function test_admin_can_view_hasil_detail(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Ensure data exists
        $hasil = Hasil::first();
        if (!$hasil) {
            // Create if not exists
            $formulir = Formulir::factory()->create(['user_id' => $admin->id]);
            $hasil = Hasil::create([
                'formulir_id' => $formulir->id,
                'deskripsi' => 'Test Deskripsi',
                'tautan' => 'http://test.com'
            ]);
        }

        $this->browse(function (Browser $browser) use ($admin, $hasil) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/hasil')
                ->click("button[onclick*=\"viewHasilModal{$hasil->id}\"], a[href*=\"hasil/{$hasil->id}\"]")
                ->waitFor('#viewHasilModal' . $hasil->id . ', .modal', 5)
                ->assertSee($hasil->deskripsi);
        });
    }

    /**
     * Test admin can edit hasil.
     */
    public function test_admin_can_edit_hasil(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Create test data
        $formulir = Formulir::factory()->create(['user_id' => $admin->id]);
        $hasil = Hasil::create([
            'formulir_id' => $formulir->id,
            'deskripsi' => 'Original Deskripsi',
            'tautan' => 'http://test.com'
        ]);

        $newDeskripsi = 'Deskripsi hasil ITSA yang diperbarui untuk testing.';

        $this->browse(function (Browser $browser) use ($admin, $hasil, $newDeskripsi) {
            $browser->loginAs($admin)
                ->visit('/admin/hasil')
                ->click("button[onclick*=\"editHasilModal{$hasil->id}\"]")
                ->waitFor('#editHasilModal' . $hasil->id . ', .modal', 5)
                ->whenAvailable('.modal, [id*="HasilModal' . $hasil->id . '"]', function ($modal) use ($newDeskripsi) {
                    $modal->clear('textarea[name="deskripsi"]')
                        ->type('textarea[name="deskripsi"]', $newDeskripsi)
                        ->press('Simpan');
                })
                ->waitForText('berhasil', 10)
                ->assertSee('berhasil');
        });

        $this->assertDatabaseHas('hasil_itsa', [
            'id' => $hasil->id,
            'deskripsi' => $newDeskripsi,
        ]);

        // Cleanup
        $hasil->delete();
        $formulir->delete();
    }

    /**
     * Test admin can delete hasil.
     */
    public function test_admin_can_delete_hasil(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Create data to delete
        $formulir = Formulir::factory()->create(['user_id' => $admin->id]);
        $hasil = Hasil::create([
            'formulir_id' => $formulir->id,
            'deskripsi' => 'To Be Deleted',
            'tautan' => 'http://delete.com'
        ]);

        $hasilId = $hasil->id;

        $this->browse(function (Browser $browser) use ($admin, $hasilId) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/hasil')
                ->script("document.getElementById('delete-form-{$hasilId}').submit();");
        });

        $this->assertDatabaseMissing('hasil_itsa', ['id' => $hasilId]);
        $formulir->delete();
    }

    /**
     * Test admin can search hasil.
     */
    public function test_admin_can_search_hasil(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Create data for searching
        $formulir = Formulir::factory()->create([
            'user_id' => $admin->id,
            'nama_aplikasi' => 'UniqueSearchTerm'
        ]);
        $hasil = Hasil::create(['formulir_id' => $formulir->id, 'deskripsi' => 'foo']);

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->loginAs($admin)
                ->visit('/admin/hasil')
                ->waitFor('input[name="search"]', 5)
                ->type('input[name="search"]', 'UniqueSearchTerm')
                ->press('Cari')
                ->pause(1000)
                ->assertSee('UniqueSearchTerm'); // Assuming search searches by app name too? Or should verify
        });

        // Cleanup
        $hasil->delete();
        $formulir->delete();
    }
}
