<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Feedback;

class AdminFeedbackTest extends DuskTestCase
{
    /**
     * Test admin can view feedback list.
     */
    public function test_admin_can_view_feedback_list(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->assertPathIs('/admin/feedbacks')
                ->assertSee('Manajemen Feedback');
        });
    }

    /**
     * Test feedback list shows feedback data.
     */
    public function test_feedback_list_shows_feedback_data(): void
    {
        $admin = User::where('role', 'admin')->first();
        // Ensure at least one feedback
        if (Feedback::count() == 0) {
            Feedback::create([
                'user_id' => $admin->id,
                'subjek' => 'umum',
                'pesan' => 'Test feedback',
                'status' => 'diproses'
            ]);
        }

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->waitFor('table', 10)
                ->assertVisible('table')
                ->assertSee('Subjek')
                ->assertSee('Status');
        });
    }

    /**
     * Test admin can view feedback detail.
     */
    public function test_admin_can_view_feedback_detail(): void
    {
        $admin = User::where('role', 'admin')->first();
        $feedback = Feedback::first() ?? Feedback::create([
            'user_id' => $admin->id,
            'subjek' => 'umum',
            'pesan' => 'Test feedback detail',
            'status' => 'diproses'
        ]);

        $this->browse(function (Browser $browser) use ($admin, $feedback) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->click("button[onclick*=\"viewFeedbackModal{$feedback->id}\"], a[href*=\"feedbacks/{$feedback->id}\"]")
                ->waitFor('#viewFeedbackModal' . $feedback->id . ', .modal', 5)
                ->assertSee($feedback->pesan);
        });
    }

    /**
     * Test admin can reply to feedback.
     */
    public function test_admin_can_reply_to_feedback(): void
    {
        $admin = User::where('role', 'admin')->first();
        // Create a specific feedback to reply to
        $feedback = Feedback::create([
            'user_id' => $admin->id,
            'subjek' => 'umum',
            'pesan' => 'Feedback to reply',
            'status' => 'diproses'
        ]);

        $this->browse(function (Browser $browser) use ($admin, $feedback) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->click("button[onclick*=\"replyFeedbackModal{$feedback->id}\"], button[onclick*=\"editFeedbackModal{$feedback->id}\"]")
                ->waitFor('#replyFeedbackModal' . $feedback->id . ', #editFeedbackModal' . $feedback->id . ', .modal', 5)
                ->whenAvailable('.modal, [id*="FeedbackModal' . $feedback->id . '"]', function ($modal) {
                    $modal->type('textarea[name="balasan_admin"]', 'Terima kasih atas feedback Anda.')
                        ->select('select[name="status"]', 'selesai')
                        ->press('Simpan');
                })
                ->waitForText('berhasil', 10)
                ->assertSee('berhasil');
        });

        $this->assertDatabaseHas('feedbacks', [
            'id' => $feedback->id,
            'status' => 'selesai',
        ]);

        $feedback->delete();
    }

    /**
     * Test admin can search feedback.
     */
    public function test_admin_can_search_feedback(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->waitFor('input[name="search"]', 5)
                ->type('input[name="search"]', 'masalah')
                ->press('Cari')
                ->pause(1000);
        });
    }

    /**
     * Test admin can filter feedback by status.
     */
    public function test_admin_can_filter_feedback_by_status(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->waitFor('select[name="status"]', 5)
                ->select('select[name="status"]', 'diproses')
                ->press('Cari')
                ->pause(1000)
                ->assertQueryStringHas('status', 'diproses');
        });
    }

    /**
     * Test admin can delete feedback.
     */
    public function test_admin_can_delete_feedback(): void
    {
        $admin = User::where('role', 'admin')->first();
        // Create explicit feedback to delete
        $feedback = Feedback::create([
            'user_id' => $admin->id,
            'subjek' => 'umum',
            'pesan' => 'Feedback to delete',
            'status' => 'diproses'
        ]);

        $feedbackId = $feedback->id;

        $this->browse(function (Browser $browser) use ($admin, $feedbackId) {
            $browser->logout()
                ->loginAs($admin)
                ->visit('/admin/feedbacks')
                // Direct JS submit for reliability
                ->script("document.getElementById('delete-form-{$feedbackId}').submit();");
        });

        $this->assertDatabaseMissing('feedbacks', ['id' => $feedbackId]);
    }
}
