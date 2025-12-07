<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class KontakController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index()
    {
        return view('pages.kontak');
    }

    /**
     * Store feedback in the database.
     */
    public function storeFeedback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subjek' => 'required|in:masalah_teknis,keluhan_layanan,saran_pengembangan,pertanyaan_informasi',
            'pesan' => 'required',
        ], [
            'subjek.required' => 'Silakan pilih subjek feedback.',
            'subjek.in' => 'Subjek yang dipilih tidak valid.',
            'pesan.required' => 'Pesan wajib diisi.',
            'pesan.min' => 'Pesan minimal 10 karakter.',
            'pesan.max' => 'Pesan maksimal 1000 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Simpan feedback ke database
            Feedback::create([
                'user_id' => Auth::id(),
                'subjek' => $request->subjek,
                'pesan' => $request->pesan,
                'status' => 'diproses'
            ]);

            return redirect()->back()->with('success', 'Feedback berhasil dikirim! Terima kasih atas masukan Anda.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }
}