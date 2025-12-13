<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Notifikasi;

class NotifikasiTest extends DuskTestCase
{
    /**
     * Test user can view notifikasi list.
     */
    public function test_user_can_view_notifikasi_list(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/notifikasi')
                ->assertPathIs('/notifikasi')
                ->assertSee('Notifikasi');
        });
    }

    /**
     * Test notifikasi page displays notification list.
     */
    public function test_notifikasi_page_displays_notification_list(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        // Create a notification for this user
        $notif = Notifikasi::create([
            'user_id' => $user->id,
            'judul' => 'Test Notification list',
            'pesan' => 'This is a test notification message for list',
            'type' => 'info',
            'is_read' => false,
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/notifikasi')
                ->waitFor('.notification-item, [class*="notification"], table', 10)
                ->assertSee('Test Notification list');
        });

        $notif->delete(); // Cleanup
    }

    /**
     * Test user can view notifikasi detail.
     */
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
            $browser->logout()
                ->loginAs($user)
                ->visit('/notifikasi/' . $notifikasi->id)
                ->assertSee('Detail Test Notification')
                ->assertSee('This is the detailed message content');
        });

        $notifikasi->delete(); // Cleanup
    }

    /**
     * Test user can mark notifikasi as read.
     */
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
            $browser->logout()
                ->loginAs($user)
                ->visit('/notifikasi/' . $notifikasi->id)
                ->pause(1000); // Wait for mark as read to trigger
        });

        // Verify notification is marked as read
        $this->assertTrue(Notifikasi::find($notifikasi->id)->is_read == 1); // Strict check might fail on diff types, using loose check

        $notifikasi->delete(); // Cleanup
    }

    /**
     * Test user can mark all notifikasi as read.
     */
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
            $browser->logout()
                ->loginAs($user)
                ->visit('/notifikasi')
                // Attempt to find the button, might need adjustment based on real UI
                ->waitFor('button[title*="Tandai"], [onclick*="markAllAsRead"]', 5)
                ->click('button[title*="Tandai"], [onclick*="markAllAsRead"]')
                ->pause(1000)
                ->assertSee('berhasil');
        });
    }

    /**
     * Test user can delete notifikasi.
     */
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

        // We use a separate browser session to ensure we see the button
        $this->browse(function (Browser $browser) use ($user, $notifikasi) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/notifikasi')
                ->waitFor('form[action*="notifikasi/' . $notifikasi->id . '"] button, button[onclick*="delete"]', 10)
                // Use script to force submit if button is tricky
                ->script("document.querySelector('form[action*=\"notifikasi/{$notifikasi->id}\"]').submit();");

            $browser->pause(1000);
        });

        $this->assertDatabaseMissing('notifikasi', ['id' => $notifikasi->id]);
    }

    /**
     * Test unread notification count displays.
     */
    public function test_unread_notification_count_displays(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        // Create unread notifications
        $notif = Notifikasi::create([
            'user_id' => $user->id,
            'judul' => 'Count Test',
            'pesan' => 'Test message',
            'type' => 'info',
            'is_read' => false,
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/dashboard')
                ->assertPresent('.notification-count, [class*="badge"], .unread-count');
        });

        $notif->delete();
    }
}
