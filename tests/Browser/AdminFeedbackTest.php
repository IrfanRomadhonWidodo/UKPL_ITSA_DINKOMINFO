<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminFeedbackTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Test admin can view feedback list.
     */
    public function test_admin_can_view_feedback_list(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->assertPathIs('/admin/feedbacks')
                ->assertSee('Manajemen Feedback')
                ->assertSee('Kelola feedback dari pengguna');
        });
    }

    /**
     * Test feedback list shows feedback data.
     */
    public function test_feedback_list_shows_feedback_data(): void
    {
        $admin = User::where('role', 'admin')->first();
        $feedback = Feedback::first();

        $this->browse(function (Browser $browser) use ($admin, $feedback) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->type('search', substr($feedback->pesan, 0, 10))
                ->press('Cari')
                ->waitForText(Str::limit($feedback->pesan, 50))
                ->assertSee(Str::limit($feedback->pesan, 50));
        });
    }

    /**
     * Test admin can view feedback detail.
     */
    public function test_admin_can_view_feedback_detail(): void
    {
        $admin = User::where('role', 'admin')->first();
        $feedback = Feedback::first();

        $this->browse(function (Browser $browser) use ($admin, $feedback) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->type('search', substr($feedback->pesan, 0, 10))
                ->press('Cari')
                ->waitForText(Str::limit($feedback->pesan, 50))
                ->click("button[onclick=\"openModal('viewFeedbackModal{$feedback->id}')\"]")
                ->waitFor("#viewFeedbackModal{$feedback->id}", 5)
                ->with("#viewFeedbackModal{$feedback->id}", function ($modal) use ($feedback) {
                    $modal->assertSee('Detail Feedback')
                        ->assertSee($feedback->pesan)
                        ->assertSee($feedback->user->name);
                });
        });
    }

    /**
     * Test admin can reply to feedback.
     */
    public function test_admin_can_reply_to_feedback(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Pick a feedback that hasn't been replied to yet (all are null in seeder)
        $feedback = Feedback::whereNull('balasan_admin')->first();

        $this->browse(function (Browser $browser) use ($admin, $feedback) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->type('search', substr($feedback->pesan, 0, 10))
                ->press('Cari')
                ->waitForText(Str::limit($feedback->pesan, 50))
                ->click("button[onclick=\"openModal('replyFeedbackModal{$feedback->id}')\"]")
                ->waitFor("#replyFeedbackModal{$feedback->id}", 5)
                ->with("#replyFeedbackModal{$feedback->id}", function ($modal) {
                    $modal->type('balasan_admin', 'Ini adalah balasan resmi admin.')
                        ->press('Kirim Balasan');
                })
                ->waitForLocation('/admin/feedbacks')
                ->assertSee('Berhasil!');

            $this->assertDatabaseHas('feedbacks', [
                'id' => $feedback->id,
                'balasan_admin' => 'Ini adalah balasan resmi admin.'
            ]);
        });
    }

    /**
     * Test admin can search feedback.
     */
    public function test_admin_can_search_feedback(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Update a specific feedback to have a unique message for searching
        $uniqueMessage = 'UniqueSearchTerm_' . Str::random(5);
        $targetFeedback = Feedback::first();
        $targetFeedback->update(['pesan' => $uniqueMessage]);

        // Another feedback to ensure it's NOT seen
        $otherFeedback = Feedback::where('id', '!=', $targetFeedback->id)->first();

        $this->browse(function (Browser $browser) use ($admin, $uniqueMessage, $otherFeedback) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->type('search', $uniqueMessage)
                ->press('Cari')
                ->waitForText($uniqueMessage)
                ->assertSee($uniqueMessage)
                ->assertDontSee(Str::limit($otherFeedback->pesan, 20));
        });
    }

    /**
     * Test admin can filter feedback by status.
     */
    public function test_admin_can_filter_feedback_by_status(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Seeder creates 'diproses'. Let's mark one as 'selesai'.
        $feedbackSelesai = Feedback::first();
        $feedbackSelesai->update(['status' => 'selesai', 'pesan' => 'StatusSelesaiCheck']);

        $feedbackDiproses = Feedback::where('id', '!=', $feedbackSelesai->id)->first();
        $feedbackDiproses->update(['pesan' => 'StatusDiprosesCheck']);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->select('status', 'selesai')
                ->press('Cari')
                ->waitForText('StatusSelesaiCheck')
                ->assertSee('StatusSelesaiCheck')
                ->assertDontSee('StatusDiprosesCheck');
        });
    }

    /**
     * Test admin can delete feedback.
     */
    public function test_admin_can_delete_feedback(): void
    {
        $admin = User::where('role', 'admin')->first();
        $feedback = Feedback::first();

        $this->browse(function (Browser $browser) use ($admin, $feedback) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->type('search', substr($feedback->pesan, 0, 10))
                ->press('Cari')
                ->waitForText(Str::limit($feedback->pesan, 50))
                ->click("button[onclick=\"deleteFeedback({$feedback->id})\"]")
                ->waitFor('.swal2-container', 5)
                ->click('.swal2-confirm')
                ->waitUntilMissing('#delete-form-' . $feedback->id)
                ->assertPathIs('/admin/feedbacks');

            $this->assertDatabaseMissing('feedbacks', ['id' => $feedback->id]);
        });
    }
}