<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Support\Str;

class AdminFeedbackTest extends DuskTestCase
{
    /**
     * Test admin can view feedback list.
     */
    public function test_admin_can_view_feedback_list(): void
    {
        $admin = User::where('role', 'admin')->first();
        if (!$admin) {
            $admin = User::factory()->create(['role' => 'admin']);
        }

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

        $feedback = Feedback::create([
            'user_id' => $admin->id,
            'subjek' => 'masalah_teknis',
            'pesan' => 'Test feedback for list view',
            'status' => 'diproses'
        ]);

        $this->browse(function (Browser $browser) use ($admin, $feedback) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->waitForText('Test feedback for list view')
                ->assertSee('Masalah Teknis')
                ->assertSee(Str::limit($feedback->pesan, 50));
        });
    }

    /**
     * Test admin can view feedback detail.
     */
    public function test_admin_can_view_feedback_detail(): void
    {
        $admin = User::where('role', 'admin')->first();
        $feedback = Feedback::create([
            'user_id' => $admin->id,
            'subjek' => 'pertanyaan_informasi',
            'pesan' => 'I verified this message content',
            'status' => 'diproses'
        ]);

        $this->browse(function (Browser $browser) use ($admin, $feedback) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->waitForText('I verified this message content')
                ->click("button[onclick=\"openModal('viewFeedbackModal{$feedback->id}')\"]")
                ->waitFor("#viewFeedbackModal{$feedback->id}", 5)
                ->with("#viewFeedbackModal{$feedback->id}", function ($modal) use ($feedback) {
                    $modal->assertSee('Detail Feedback')
                        ->assertSee('I verified this message content')
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
        $feedback = Feedback::create([
            'user_id' => $admin->id,
            'subjek' => 'saran_pengembangan',
            'pesan' => 'Feedback needing reply',
            'status' => 'diproses'
        ]);

        $this->browse(function (Browser $browser) use ($admin, $feedback) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->waitForText('Feedback needing reply')
                ->click("button[onclick=\"openModal('replyFeedbackModal{$feedback->id}')\"]")
                ->waitFor("#replyFeedbackModal{$feedback->id}", 5)
                ->with("#replyFeedbackModal{$feedback->id}", function ($modal) {
                    $modal->type('balasan_admin', 'Ini adalah balasan resmi admin.')
                        ->press('Kirim Balasan');
                })
                ->waitForLocation('/admin/feedbacks')
                ->assertSee('Berhasil!'); // SweetAlert success message

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
        Feedback::create([
            'user_id' => $admin->id,
            'subjek' => 'masalah_teknis',
            'pesan' => 'UniqueSearchTerm',
            'status' => 'selesai'
        ]);

        Feedback::create([
            'user_id' => $admin->id,
            'subjek' => 'keluhan_layanan',
            'pesan' => 'OtherMessage',
            'status' => 'selesai'
        ]);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->type('search', 'UniqueSearchTerm')
                ->press('Cari')
                ->waitForText('UniqueSearchTerm')
                ->assertSee('UniqueSearchTerm')
                ->assertDontSee('OtherMessage');
        });
    }

    /**
     * Test admin can filter feedback by status.
     */
    public function test_admin_can_filter_feedback_by_status(): void
    {
        $admin = User::where('role', 'admin')->first();
        Feedback::create([
            'user_id' => $admin->id,
            'subjek' => 'masalah_teknis',
            'pesan' => 'StatusDiproses',
            'status' => 'diproses'
        ]);

        Feedback::create([
            'user_id' => $admin->id,
            'subjek' => 'masalah_teknis',
            'pesan' => 'StatusSelesai',
            'status' => 'selesai'
        ]);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->select('status', 'diproses')
                ->press('Cari')
                ->waitForText('StatusDiproses')
                ->assertSee('StatusDiproses')
                ->assertDontSee('StatusSelesai');
        });
    }

    /**
     * Test admin can delete feedback.
     */
    public function test_admin_can_delete_feedback(): void
    {
        $admin = User::where('role', 'admin')->first();
        $feedback = Feedback::create([
            'user_id' => $admin->id,
            'subjek' => 'masalah_teknis',
            'pesan' => 'ToBeDeleted',
            'status' => 'diproses'
        ]);

        $this->browse(function (Browser $browser) use ($admin, $feedback) {
            $browser->loginAs($admin)
                ->visit('/admin/feedbacks')
                ->waitForText('ToBeDeleted')
                ->click("button[onclick=\"deleteFeedback({$feedback->id})\"]")
                ->waitFor('.swal2-container', 5)
                ->click('.swal2-confirm')
                ->waitUntilMissing('#delete-form-' . $feedback->id)
                ->assertPathIs('/admin/feedbacks');

            $this->assertDatabaseMissing('feedbacks', ['id' => $feedback->id]);
        });
    }
}
