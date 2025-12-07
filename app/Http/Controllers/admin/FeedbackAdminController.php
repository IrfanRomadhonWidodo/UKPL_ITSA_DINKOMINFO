<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class FeedbackAdminController extends Controller
{
    /**
     * Menampilkan daftar feedback dengan fungsionalitas pencarian.
     */
    public function index(Request $request)
    {
        $query = Feedback::with('user');

        // Logika untuk pencarian
        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $query->where('subjek', 'like', $searchTerm)
                  ->orWhere('pesan', 'like', $searchTerm)
                  ->orWhere('status', 'like', $searchTerm)
                  ->orWhereHas('user', function($q) use ($searchTerm) {
                      $q->where('name', 'like', $searchTerm);
                  });
        }

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $feedbacks = $query->latest()->paginate(10);
        return view('admin.feedbacks', compact('feedbacks'));
    }

    /**
     * Menampilkan detail feedback.
     */
    public function show(Feedback $feedback)
    {
        $feedback->load('user');
        return response()->json($feedback);
    }

    /**
     * Memperbarui feedback (untuk balasan admin).
     */
    public function update(Request $request, Feedback $feedback)
    {
        $request->validate([
            'balasan_admin' => ['required', 'string'],
        ]);

        $feedback->update([
            'balasan_admin' => $request->balasan_admin,
            'status' => 'selesai', // Otomatis set ke selesai jika sudah ada balasan
        ]);

        // Buat notifikasi untuk user
        Notifikasi::create([
            'user_id' => $feedback->user_id,
            'judul' => 'Balasan Feedback: ' . $feedback->subjek_label,
            'pesan' => 'Admin telah memberikan balasan untuk feedback Anda mengenai "' . $feedback->subjek_label . '".',
            'type' => 'feedback',
            'feedback_id' => $feedback->id,
            'is_read' => false,
        ]);

        return redirect()->route('admin.feedbacks.index')->with('success', 'Feedback berhasil dibalas dan notifikasi telah dikirim ke user.');
    }

    /**
     * Menghapus feedback dari database.
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('admin.feedbacks.index')->with('success', 'Feedback berhasil dihapus.');
    }
}