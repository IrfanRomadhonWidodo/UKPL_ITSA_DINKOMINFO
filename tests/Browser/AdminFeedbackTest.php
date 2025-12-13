<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminFeedbackTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_admin_can_view_feedback_list(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->assertPathIs('/admin/feedbacks')
                ->assertSee('Manajemen Feedback');
        });
    }

    public function test_feedback_list_shows_feedback_data(): void
    {
        $admin = User::where('role', 'admin')->first();
        $feedback = Feedback::first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->waitFor('table', 10)
                ->assertVisible('table')
                ->assertSee('Subjek')
                ->assertSee('Status');
        });
    }

    public function test_admin_can_view_feedback_detail(): void
    {
        $admin = User::where('role', 'admin')->first();
        $feedback = Feedback::first();

        if (!$feedback) {
            $this->markTestSkipped('No feedback data available');
        }

        $this->browse(function (Browser $browser) use ($admin, $feedback) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->click("button[onclick*=\"viewFeedbackModal{$feedback->id}\"], a[href*=\"feedbacks/{$feedback->id}\"]")
                ->waitFor('#viewFeedbackModal' . $feedback->id . ', .modal', 5)
                ->assertSee($feedback->pesan);
        });
    }

    public function test_admin_can_reply_to_feedback(): void
    {
        $admin = User::where('role', 'admin')->first();
        $feedback = Feedback::where('status', 'diproses')->first();

        if (!$feedback) {
            $this->markTestSkipped('No pending feedback available');
        }

        $this->browse(function (Browser $browser) use ($admin, $feedback) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->click("button[onclick*=\"replyFeedbackModal{$feedback->id}\"], button[onclick*=\"editFeedbackModal{$feedback->id}\"]")
                ->waitFor('#replyFeedbackModal' . $feedback->id . ', #editFeedbackModal' . $feedback->id . ', .modal', 5)
                ->whenAvailable('.modal, [id*="FeedbackModal' . $feedback->id . '"]', function ($modal) {
                    $modal->type('textarea[name="balasan_admin"]', 'Terima kasih atas feedback Anda. Kami akan segera menindaklanjuti.')
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
    }

    public function test_admin_can_search_feedback(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->waitFor('input[name="search"]', 5)
                ->type('input[name="search"]', 'masalah')
                ->press('Cari')
                ->pause(1000);
        });
    }

    public function test_admin_can_filter_feedback_by_status(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->waitFor('select[name="status"]', 5)
                ->select('select[name="status"]', 'diproses')
                ->press('Cari')
                ->pause(1000)
                ->assertQueryStringHas('status', 'diproses');
        });
    }

    public function test_admin_can_delete_feedback(): void
    {
        $admin = User::where('role', 'admin')->first();
        $feedback = Feedback::first();

        if (!$feedback) {
            $this->markTestSkipped('No feedback data available');
        }

        $feedbackId = $feedback->id;

        $this->browse(function (Browser $browser) use ($admin, $feedbackId) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->script("document.getElementById('delete-form-{$feedbackId}').submit();");
        });

        $this->assertDatabaseMissing('feedbacks', ['id' => $feedbackId]);
    }
}
