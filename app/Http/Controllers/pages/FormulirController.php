<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formulir;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FormulirController extends Controller
{
    public function index()
    {
        return view('pages.formulir');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Step 1: Data Sistem
            'nama_aplikasi' => 'required|string|max:255',
            'domain_aplikasi' => 'nullable|string|max:255',
            'ip_jenis' => 'nullable|in:lokal,public',
            'ip_address' => 'nullable|ip',

            // Step 2: Data Pejabat Penandatangan NDA
            'pejabat_nama' => 'required|string|max:255',
            'pejabat_nip' => 'required|string|max:255',
            'pejabat_pangkat' => 'required|string|max:255',
            'pejabat_jabatan' => 'required|string|max:255',

            // Step 3: Teknis dan Keamanan
            'tujuan_sistem' => 'nullable|string',
            'pengguna_sistem' => 'nullable|string',
            'hosting' => 'nullable|string',
            'framework' => 'nullable|string|max:255',
            'pengelola_sistem' => 'nullable|string',
            'jumlah_roles' => 'nullable|integer|min:0',
            'nama_roles' => 'nullable|string|max:255',
            'mekanisme_account' => 'nullable|string',
            'mekanisme_kredensial' => 'nullable|string',
            'fitur_reset_password' => 'nullable|in:ada,tidak',
            'pic_pengelola' => 'nullable|string|max:255',
            'keterangan_tambahan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Update hanya draft yang belum disubmit
            $formulir = Formulir::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'status' => 'draft'
                ],
                array_merge($request->all(), [
                    'user_id' => Auth::id(),
                    // Perbaikan: langsung ambil nilai dari request
                    'fitur_reset_password' => $request->input('fitur_reset_password'),
                    'status' => 'draft'
                ])
            );

            return response()->json([
                'success' => true,
                'message' => 'Formulir berhasil disimpan',
                'data' => $formulir
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan formulir'
            ], 500);
        }
    }

    public function autoSave(Request $request)
    {
        try {
            // Auto save hanya untuk draft
            $formulir = Formulir::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'status' => 'draft'
                ],
                array_merge($request->all(), [
                    'user_id' => Auth::id(),
                    // Perbaikan: langsung ambil nilai dari request
                    'fitur_reset_password' => $request->input('fitur_reset_password'),
                    'status' => 'draft'
                ])
            );

            return response()->json([
                'success' => true,
                'message' => 'Auto save berhasil',
                'data' => $formulir
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Auto save gagal'
            ], 500);
        }
    }

    public function getData()
    {
        // Ambil draft yang belum disubmit untuk di-load ke form
        $formulir = Formulir::where('user_id', Auth::id())
                           ->where('status', 'draft')
                           ->first();
        
        return response()->json([
            'success' => true,
            'data' => $formulir
        ]);
    }

    public function preview(Request $request)
    {
        $formulir = Formulir::where('user_id', Auth::id())
                           ->where('status', 'draft')
                           ->first();
        
        if (!$formulir) {
            return response()->json([
                'success' => false,
                'message' => 'Data formulir tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $formulir
        ]);
    }

    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_aplikasi' => 'required|string|max:255',
            'pejabat_nama' => 'required|string|max:255',
            'pejabat_nip' => 'required|string|max:255',
            'pejabat_pangkat' => 'required|string|max:255',
            'pejabat_jabatan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Selalu buat record baru untuk setiap submission
            $formulir = Formulir::create(array_merge($request->all(), [
                'user_id' => Auth::id(),
                // Perbaikan: langsung ambil nilai dari request
                'fitur_reset_password' => $request->input('fitur_reset_password'),
                'status' => 'diproses'
            ]));

            // Hapus draft setelah berhasil submit
            Formulir::where('user_id', Auth::id())
                   ->where('status', 'draft')
                   ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Formulir berhasil dikirim dan sedang diproses',
                'data' => $formulir
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengirim formulir'
            ], 500);
        }
    }

    /**
     * Menampilkan daftar formulir yang sudah disubmit oleh user
     */
    public function history()
    {
        $formulir = Formulir::where('user_id', Auth::id())
                           ->where('status', '!=', 'draft')
                           ->orderBy('created_at', 'desc')
                           ->get();

        return response()->json([
            'success' => true,
            'data' => $formulir
        ]);
    }

    /**
     * Menampilkan detail formulir berdasarkan ID
     */
    public function show($id)
    {
        $formulir = Formulir::where('user_id', Auth::id())
                           ->where('id', $id)
                           ->first();

        if (!$formulir) {
            return response()->json([
                'success' => false,
                'message' => 'Formulir tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $formulir
        ]);
    }
}