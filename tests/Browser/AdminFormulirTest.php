<?php

namespace Tests\Browser;

use App\Models\Formulir;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminFormulirTest extends DuskTestCase
{
    public function test_admin_can_view_formulir_list(): void
    {
        $admin = User::firstWhere('role', 'admin')
            ?? User::factory()->create(['role' => 'admin']);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/formulir')
                ->assertPathIs('/admin/formulir')
                ->assertSee('Manajemen Formulir');
        });
    }

    public function test_formulir_list_shows_data(): void
    {
        $admin = User::firstWhere('role', 'admin');

        $formulir = Formulir::factory()->create([
            'user_id' => $admin->id,
            'ip_jenis' => 'public',
            'nama_aplikasi' => 'Formulir Test View',
        ]);

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->loginAs($admin)
                ->visit('/admin/formulir')
                ->waitForText('Formulir Test View')
                ->assertSee('Formulir Test View');
        });
    }

    public function test_admin_can_view_formulir_detail(): void
    {
        $admin = User::firstWhere('role', 'admin');

        $formulir = Formulir::factory()->create([
            'user_id' => $admin->id,
            'ip_jenis' => 'public',
            'nama_aplikasi' => 'Detail Formulir Test',
        ]);

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->loginAs($admin)
                ->visit('/admin/formulir')
                ->waitForText('Detail Formulir Test')
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
        $admin = User::firstWhere('role', 'admin');

        $formulir = Formulir::factory()->create([
            'user_id' => $admin->id,
            'ip_jenis' => 'public',
            'status' => 'diproses',
        ]);

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->loginAs($admin)
                ->visit('/admin/formulir')
                ->waitForText($formulir->nama_aplikasi)
                ->click("button[onclick=\"openModal('replyFormulirModal{$formulir->id}')\"]")
                ->waitFor("#replyFormulirModal{$formulir->id}", 5)
                ->with("#replyFormulirModal{$formulir->id}", function ($modal) {
                    $modal->type('balasan_admin', 'Balasan dari admin')
                          ->press('Kirim Balasan');
                })
                ->waitForLocation('/admin/formulir');
        });

        $this->assertDatabaseHas('formulir', [
            'id' => $formulir->id,
            'status' => 'revisi',
        ]);
    }

    /**
     * 🔍 Test admin can search formulir
     */
    public function test_admin_can_search_formulir(): void
    {
        $admin = User::firstWhere('role', 'admin');

        Formulir::factory()->create([
            'user_id' => $admin->id,
            'ip_jenis' => 'public',
            'nama_aplikasi' => 'UniqueSearchFormulir',
            'status' => 'diproses',
        ]);

        Formulir::factory()->create([
            'user_id' => $admin->id,
            'ip_jenis' => 'public',
            'nama_aplikasi' => 'OtherFormulir',
            'status' => 'diproses',
        ]);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/formulir')
                ->type('search', 'UniqueSearchFormulir')
                ->press('Cari')
                ->waitForText('UniqueSearchFormulir')
                ->assertSee('UniqueSearchFormulir')
                ->assertDontSee('OtherFormulir');
        });
    }

    /**
     * 🔽 Test admin can filter formulir by status
     */
    public function test_admin_can_filter_formulir_by_status(): void
    {
        $admin = User::firstWhere('role', 'admin');

        Formulir::factory()->create([
            'user_id' => $admin->id,
            'ip_jenis' => 'public',
            'nama_aplikasi' => 'Formulir Diproses',
            'status' => 'diproses',
        ]);

        Formulir::factory()->create([
            'user_id' => $admin->id,
            'ip_jenis' => 'public',
            'nama_aplikasi' => 'Formulir Selesai',
            'status' => 'selesai',
        ]);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/formulir')
                ->select('status', 'diproses')
                ->press('Cari')
                ->waitForText('Formulir Diproses')
                ->assertSee('Formulir Diproses')
                ->assertDontSee('Formulir Selesai');
        });
    }

    public function test_admin_can_delete_formulir(): void
    {
        $admin = User::firstWhere('role', 'admin');

        $formulir = Formulir::factory()->create([
            'user_id' => $admin->id,
            'ip_jenis' => 'public',
            'nama_aplikasi' => 'Formulir Delete Test',
        ]);

        $this->browse(function (Browser $browser) use ($admin, $formulir) {
            $browser->loginAs($admin)
                ->visit('/admin/formulir')
                ->waitForText('Formulir Delete Test')
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
