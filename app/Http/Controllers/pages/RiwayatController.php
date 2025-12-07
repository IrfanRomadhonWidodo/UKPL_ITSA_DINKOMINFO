<?php
namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Formulir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RiwayatController extends Controller
{
    /**
     * Display the riwayat page
     */
    public function index()
    {
        $formulir = Formulir::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('pages.riwayat', compact('formulir'));
    }

    /**
     * Show detail formulir
     */
    public function show($id)
    {
        $formulir = Formulir::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();
        return view('pages.riwayat-detail', compact('formulir'));
    }

    /**
     * Update formulir data
     */
    public function update(Request $request, $id)
    {
        try {
            // Find formulir
            $formulir = Formulir::where('user_id', Auth::id())
                ->where('id', $id)
                ->firstOrFail();

            // Check if formulir can be edited (only diproses or revisi status)
            if (!in_array($formulir->status, ['diproses', 'revisi'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Formulir tidak dapat diedit pada status ini.'
                ], 400);
            }

            // Validation rules
            $rules = [
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
            ];

            // Validate request
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Update formulir
            $formulir->update($request->only([
                'nama_aplikasi',
                'domain_aplikasi',
                'ip_jenis',
                'ip_address',
                'pejabat_nama',
                'pejabat_nip',
                'pejabat_pangkat',
                'pejabat_jabatan',
                'tujuan_sistem',
                'pengguna_sistem',
                'hosting',
                'framework',
                'pengelola_sistem',
                'jumlah_roles',
                'nama_roles',
                'mekanisme_account',
                'mekanisme_kredensial',
                'fitur_reset_password',
                'pic_pengelola',
                'keterangan_tambahan'
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $formulir->fresh()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Download PDF hasil ITSA
     */
    public function downloadPdf($id)
    {
        $formulir = Formulir::where('user_id', Auth::id())
            ->where('id', $id)
            ->where('status', 'selesai')
            ->firstOrFail();

        if (!$formulir->file_hasil_itsa) {
            return redirect()->back()->with('error', 'File PDF tidak tersedia.');
        }

        $filePath = storage_path('app/public/' . $formulir->file_hasil_itsa);
       
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return Response::download($filePath, 'ITSA_' . $formulir->nama_aplikasi . '.pdf');
    }

    /**
     * Get status badge class
     */
    public static function getStatusBadgeClass($status)
    {
        switch ($status) {
            case 'diproses':
                return 'bg-yellow-100 text-yellow-800 border-yellow-200';
            case 'revisi':
                return 'bg-red-100 text-red-800 border-red-200';
            case 'selesai':
                return 'bg-green-100 text-green-800 border-green-200';
            default:
                return 'bg-gray-100 text-gray-800 border-gray-200';
        }
    }

    /**
     * Get status text
     */
    public static function getStatusText($status)
    {
        switch ($status) {
            case 'diproses':
                return 'Diproses';
            case 'revisi':
                return 'Revisi';
            case 'selesai':
                return 'Selesai';
            default:
                return 'Diproses';
        }
    }
}