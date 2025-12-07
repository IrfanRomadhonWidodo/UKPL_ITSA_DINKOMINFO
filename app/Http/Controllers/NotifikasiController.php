<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    /**
     * Menampilkan halaman notifikasi user.
     */
    public function index()
    {
        $notifikasi = Notifikasi::where('user_id', Auth::id())
                               ->with('feedback','formulir')
                               ->latest()
                               ->paginate(10);

        // Hitung jumlah notifikasi yang belum dibaca
        $unreadCount = Notifikasi::where('user_id', Auth::id())
                                 ->where('is_read', false)
                                 ->count();

        return view('pages.notifikasi', compact('notifikasi', 'unreadCount'));
    }

    /**
     * Tandai notifikasi sebagai sudah dibaca.
     */
    public function markAsRead($id)
    {
        $notifikasi = Notifikasi::where('id', $id)
                               ->where('user_id', Auth::id())
                               ->first();

        if ($notifikasi) {
            $notifikasi->markAsRead();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    /**
     * Tandai semua notifikasi sebagai sudah dibaca.
     */
    public function markAllAsRead()
    {
        Notifikasi::where('user_id', Auth::id())
            ->where('is_read', 0) // gunakan 0 jika di database nilainya 0/1
            ->update(['is_read' => 1]);

        return response()->json(['success' => true]);
    }

    /**
     * Lihat detail notifikasi dan balasan feedback.
     */
    public function show($id)
    {
        $notifikasi = Notifikasi::with('feedback','formulir')
                            ->where('id', $id)
                            ->where('user_id', Auth::id())
                            ->firstOrFail();

        // Tandai sebagai sudah dibaca
        if (!$notifikasi->is_read) {
            $notifikasi->markAsRead();
        }

    // Pilih view berdasarkan type atau pola judul
    if ($notifikasi->type == 'formulir') {
        if (str_starts_with($notifikasi->judul, 'Revisi Formulir:')) {
            return view('pages.notifikasi-formulir-revisi', compact('notifikasi'));
        } elseif (str_starts_with($notifikasi->judul, 'File Hasil ITSA:')) {
            return view('pages.notifikasi-formulir-hasil', compact('notifikasi'));
        }
    }

    // Default
    return view('pages.notifikasi-detail', compact('notifikasi'));
}

        /**
         * Hapus satu notifikasi.
         */
        public function destroy($id)
        {
            $notifikasi = Notifikasi::where('id', $id)
                                    ->where('user_id', Auth::id())
                                    ->first();

            if ($notifikasi) {
                $notifikasi->delete();
                return response()->json(['success' => true, 'message' => 'Notifikasi berhasil dihapus.']);
            }

            return response()->json(['success' => false, 'message' => 'Notifikasi tidak ditemukan.'], 404);
        }

    /**
     * Hapus semua notifikasi milik user.
     */
    public function destroyAll()
    {
        Notifikasi::where('user_id', Auth::id())->delete();
        return response()->json(['success' => true, 'message' => 'Semua notifikasi berhasil dihapus.']);
    }

    /**
     * Hapus beberapa notifikasi terpilih.
     */
    public function deleteMultiple(Request $request)
    {
        $ids = $request->input('ids');

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['success' => false, 'message' => 'Tidak ada notifikasi yang dipilih.']);
        }

        try {
            Notifikasi::where('user_id', Auth::id())
                      ->whereIn('id', $ids)
                      ->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus notifikasi.']);
        }
    }
}