<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Notifikasi;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NotifikasiTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Test user can open, view notification detail, and go back.
     */
    public function test_user_can_open_view_detail_and_go_back(): void
    {
        $user = User::where('email', 'user_approved0@example.com')->first();
        $notifikasi = Notifikasi::where('user_id', $user->id)->first();

        if (!$notifikasi) {
            $this->markTestSkipped('No notification data available for this user');
        }

        $this->browse(function (Browser $browser) use ($user, $notifikasi) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/notifikasi')
                ->waitUntilMissing('#loading-screen', 5)
                ->assertSee('Notifikasi')
                ->click("a[href*='/notifikasi/{$notifikasi->id}']")
                ->waitUntilMissing('#loading-screen', 5)
                ->assertPathIs('/notifikasi/' . $notifikasi->id)
                ->assertSee($notifikasi->judul)
                ->assertSee('Kembali ke Notifikasi')
                ->clickLink('Kembali ke Notifikasi')
                ->assertPathIs('/notifikasi');
        });
    }

    /**
     * Test user can select all and delete all notifications.
     */
    public function test_user_can_select_all_and_delete_notifications(): void
    {
        $user = User::where('email', 'user_approved0@example.com')->first();

        // Ensure user has exactly 3 notifications (User 0 has 4 by default, remove 'info' type)
        Notifikasi::where('user_id', $user->id)->where('type', 'info')->delete();

        $notifCount = Notifikasi::where('user_id', $user->id)->count();
        if ($notifCount != 3) {
            $this->markTestSkipped("Test requires exactly 3 notifications, found {$notifCount}");
        }

        $this->browse(function (Browser $browser) use ($user) {
            $browser->resize(1280, 800)
                ->loginAs($user)
                ->visit('/notifikasi')
                ->waitUntilMissing('#loading-screen', 10)
                ->waitFor('#selectAllCheckbox', 10)
                ->check('#selectAllCheckbox')
                ->waitFor('#deleteSelectedBtn', 5)
                ->click('#deleteSelectedBtn')
                ->waitFor('.swal2-confirm', 5)
                ->click('.swal2-confirm')
                ->pause(2000) // Wait for AJAX and animation
                ->assertSee('Berhasil'); // Verify success message
        });
    }
}
