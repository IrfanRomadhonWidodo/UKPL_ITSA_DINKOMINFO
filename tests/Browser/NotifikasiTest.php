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

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_user_can_view_notifikasi_list(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/notifikasi')
                ->assertPathIs('/notifikasi')
                ->assertSee('Notifikasi');
        });
    }

    public function test_notifikasi_page_displays_notification_list(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        // Create a notification for this user
        Notifikasi::create([
            'user_id' => $user->id,
            'judul' => 'Test Notification',
            'pesan' => 'This is a test notification message',
            'type' => 'info',
            'is_read' => false,
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/notifikasi')
                ->waitFor('.notification-item, [class*="notification"], table', 10)
                ->assertSee('Test Notification');
        });
    }

    public function test_user_can_view_notifikasi_detail(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $notifikasi = Notifikasi::create([
            'user_id' => $user->id,
            'judul' => 'Detail Test Notification',
            'pesan' => 'This is the detailed message content',
            'type' => 'info',
            'is_read' => false,
        ]);

        $this->browse(function (Browser $browser) use ($user, $notifikasi) {
            $browser->loginAs($user)
                ->visit('/notifikasi/' . $notifikasi->id)
                ->assertSee('Detail Test Notification')
                ->assertSee('This is the detailed message content');
        });
    }

    public function test_user_can_mark_notifikasi_as_read(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $notifikasi = Notifikasi::create([
            'user_id' => $user->id,
            'judul' => 'Mark Read Test',
            'pesan' => 'This notification will be marked as read',
            'type' => 'info',
            'is_read' => false,
        ]);

        $this->browse(function (Browser $browser) use ($user, $notifikasi) {
            $browser->loginAs($user)
                ->visit('/notifikasi/' . $notifikasi->id)
                ->pause(1000); // Wait for mark as read to trigger
        });

        // Verify notification is marked as read
        $this->assertTrue(Notifikasi::find($notifikasi->id)->is_read);
    }

    public function test_user_can_mark_all_notifikasi_as_read(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        // Create multiple unread notifications
        for ($i = 0; $i < 3; $i++) {
            Notifikasi::create([
                'user_id' => $user->id,
                'judul' => 'Batch Test Notification ' . $i,
                'pesan' => 'Test message ' . $i,
                'type' => 'info',
                'is_read' => false,
            ]);
        }

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/notifikasi')
                ->waitFor('button[title*="Tandai"], [onclick*="markAllAsRead"], button:contains("Tandai")', 5)
                ->click('button[title*="Tandai"], [onclick*="markAllAsRead"]')
                ->pause(1000)
                ->assertSee('berhasil');
        });
    }

    public function test_user_can_delete_notifikasi(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $notifikasi = Notifikasi::create([
            'user_id' => $user->id,
            'judul' => 'Delete Test',
            'pesan' => 'This notification will be deleted',
            'type' => 'info',
            'is_read' => false,
        ]);

        $this->browse(function (Browser $browser) use ($user, $notifikasi) {
            $browser->loginAs($user)
                ->visit('/notifikasi')
                ->waitFor('button[title*="Hapus"], [onclick*="delete"], form[action*="notifikasi/' . $notifikasi->id . '"]', 5)
                ->click('button[title*="Hapus"], form[action*="notifikasi/' . $notifikasi->id . '"] button')
                ->pause(1000);
        });

        $this->assertDatabaseMissing('notifikasi', ['id' => $notifikasi->id]);
    }

    public function test_unread_notification_count_displays(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        // Create unread notifications
        for ($i = 0; $i < 2; $i++) {
            Notifikasi::create([
                'user_id' => $user->id,
                'judul' => 'Count Test ' . $i,
                'pesan' => 'Test message',
                'type' => 'info',
                'is_read' => false,
            ]);
        }

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/dashboard')
                ->assertPresent('.notification-count, [class*="badge"], .unread-count');
        });
    }
}
