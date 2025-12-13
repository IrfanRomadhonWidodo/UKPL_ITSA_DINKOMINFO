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

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_admin_can_view_hasil_list(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/hasil')
                ->assertPathIs('/admin/hasil')
                ->assertSee('Hasil ITSA');
        });
    }

    public function test_hasil_list_shows_data_table(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/hasil')
                ->waitFor('table', 10)
                ->assertVisible('table');
        });
    }

    public function test_admin_can_create_hasil(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Get a formulir that doesn't have hasil yet
        $formulirWithoutHasil = Formulir::whereDoesntHave('hasilItsa')->first();

        if (!$formulirWithoutHasil) {
            $this->markTestSkipped('No formulir without hasil available');
        }

        $this->browse(function (Browser $browser) use ($admin, $formulirWithoutHasil) {
            $browser->loginAs($admin)
                ->visit('/admin/hasil')
                ->click('button[onclick*="createHasilModal"], a[href*="hasil/create"]')
                ->waitFor('#createHasilModal, .modal, form', 5)
                ->whenAvailable('.modal, form', function ($modal) use ($formulirWithoutHasil) {
                    $modal->select('select[name="formulir_id"]', $formulirWithoutHasil->id)
                        ->type('textarea[name="deskripsi"]', 'Hasil ITSA menunjukkan sistem telah memenuhi standar keamanan.')
                        ->type('input[name="tautan"]', 'https://example.com/hasil/test')
                        ->press('Simpan');
                })
                ->waitForText('berhasil', 10)
                ->assertSee('berhasil');
        });

        $this->assertDatabaseHas('hasil_itsa', [
            'formulir_id' => $formulirWithoutHasil->id,
        ]);
    }

    public function test_admin_can_view_hasil_detail(): void
    {
        $admin = User::where('role', 'admin')->first();
        $hasil = Hasil::first();

        if (!$hasil) {
            $this->markTestSkipped('No hasil data available');
        }

        $this->browse(function (Browser $browser) use ($admin, $hasil) {
            $browser->loginAs($admin)
                ->visit('/admin/hasil')
                ->click("button[onclick*=\"viewHasilModal{$hasil->id}\"], a[href*=\"hasil/{$hasil->id}\"]")
                ->waitFor('#viewHasilModal' . $hasil->id . ', .modal', 5)
                ->assertSee($hasil->deskripsi);
        });
    }

    public function test_admin_can_edit_hasil(): void
    {
        $admin = User::where('role', 'admin')->first();
        $hasil = Hasil::first();

        if (!$hasil) {
            $this->markTestSkipped('No hasil data available');
        }

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
    }

    public function test_admin_can_delete_hasil(): void
    {
        $admin = User::where('role', 'admin')->first();
        $hasil = Hasil::first();

        if (!$hasil) {
            $this->markTestSkipped('No hasil data available');
        }

        $hasilId = $hasil->id;

        $this->browse(function (Browser $browser) use ($admin, $hasilId) {
            $browser->loginAs($admin)
                ->visit('/admin/hasil')
                ->script("document.getElementById('delete-form-{$hasilId}').submit();");
        });

        $this->assertDatabaseMissing('hasil_itsa', ['id' => $hasilId]);
    }

    public function test_admin_can_search_hasil(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/hasil')
                ->waitFor('input[name="search"]', 5)
                ->type('input[name="search"]', 'SIMPEG')
                ->press('Cari')
                ->pause(1000);
        });
    }
}
