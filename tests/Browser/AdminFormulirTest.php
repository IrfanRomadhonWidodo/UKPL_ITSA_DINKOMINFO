<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Formulir;

class AdminFormulirTest extends DuskTestCase
{
    /**
     * Test admin can view formulir list.
     */
    public function test_admin_can_view_formulir_list(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/formulir')
                ->assertPathIs('/admin/formulir')
                ->assertSee('Manajemen Formulir');
        });
    }

    /**
     * Test formulir list shows data table.
     */
    public function test_formulir_list_shows_data_table(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/formulir')
                ->waitFor('table', 10)
                ->assertVisible('table')
                ->assertSee('Nama Aplikasi')
                ->assertSee('Status');
        });
    }

    /**
     * Test admin can view formulir_detail.
     */
    public function test_admin_can_view_formulir_detail(): void
    {
        $admin = User::where('role', 'admin')->first();
        $formulir = Formulir::first();

        if (!$formulir) {
            $this->markTestSkipped('No formulir data available');
        }

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/formulir')
                ->click("button[onclick*=\"viewFormulirModal{$formulir->id}\"], a[href*=\"formulir/{$formulir->id}\"]")
                ->waitFor('#viewFormulirModal' . $formulir->id . ', .modal', 5)
                ->assertSee($formulir->nama_aplikasi);
        });
    }

    /**
     * Test admin can update formulir status.
     */
    public function test_admin_can_update_formulir_status(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Create specific formulir for update test
        $formulir = Formulir::factory()->create([
            'user_id' => $admin->id, // Use admin or any user
            'status' => 'diproses',
            'nama_aplikasi' => 'App Update Status Test'
        ]);

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/formulir')
                ->click("button[onclick*=\"editFormulirModal{$formulir->id}\"]")
                ->waitFor('#editFormulirModal' . $formulir->id . ', .modal', 5)
                ->whenAvailable('.modal, [id*="FormulirModal' . $formulir->id . '"]', function ($modal) {
                    $modal->select('select[name="status"]', 'disetujui')
                        ->press('Simpan');
                })
                ->waitForText('berhasil', 10)
                ->assertSee('berhasil');
        });

        $this->assertDatabaseHas('formulir', [
            'id' => $formulir->id,
            'status' => 'disetujui',
        ]);

        $formulir->delete(); // Cleanup
    }

    /**
     * Test admin can add balasan to formulir.
     */
    public function test_admin_can_add_balasan_to_formulir(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Create specific formulir
        $formulir = Formulir::factory()->create([
            'user_id' => $admin->id,
            'status' => 'diproses',
            'nama_aplikasi' => 'App Balasan Test'
        ]);

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/formulir')
                ->click("button[onclick*=\"editFormulirModal{$formulir->id}\"]")
                ->waitFor('#editFormulirModal' . $formulir->id . ', .modal', 5)
                ->whenAvailable('.modal, [id*="FormulirModal' . $formulir->id . '"]', function ($modal) {
                    $modal->type('textarea[name="balasan_admin"]', 'Formulir Anda sedang dalam proses verifikasi. Mohon tunggu.')
                        ->press('Simpan');
                })
                ->waitForText('berhasil', 10);
        });

        $this->assertDatabaseHas('formulir', [
            'id' => $formulir->id,
            'balasan_admin' => 'Formulir Anda sedang dalam proses verifikasi. Mohon tunggu.',
        ]);

        $formulir->delete(); // Cleanup
    }

    /**
     * Test admin can search formulir.
     */
    public function test_admin_can_search_formulir(): void
    {
        $admin = User::where('role', 'admin')->first();
        $formulir = Formulir::first();

        if (!$formulir) {
            $this->markTestSkipped('No formulir available for search');
        }

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/formulir')
                ->waitFor('input[name="search"]', 5)
                ->type('input[name="search"]', $formulir->nama_aplikasi)
                ->press('Cari')
                ->pause(1000)
                ->assertSee($formulir->nama_aplikasi);
        });
    }

    /**
     * Test admin can filter formulir by status.
     */
    public function test_admin_can_filter_formulir_by_status(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/formulir')
                ->waitFor('select[name="status"]', 5)
                ->select('select[name="status"]', 'diproses')
                ->press('Cari')
                ->pause(1000)
                ->assertQueryStringHas('status', 'diproses');
        });
    }

    /**
     * Test admin can delete formulir.
     */
    public function test_admin_can_delete_formulir(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Create dummy formulir to delete
        $formulir = Formulir::factory()->create([
            'user_id' => $admin->id,
            'nama_aplikasi' => 'To Be Deleted'
        ]);
        $formulirId = $formulir->id;

        $this->browse(function (Browser $browser) use ($admin, $formulirId) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/formulir')
                ->script("document.getElementById('delete-form-{$formulirId}').submit();");
        });

        $this->assertDatabaseMissing('formulir', ['id' => $formulirId]);
    }
}
