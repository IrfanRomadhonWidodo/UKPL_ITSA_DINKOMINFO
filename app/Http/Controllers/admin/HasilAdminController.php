<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hasil;
use App\Models\Formulir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HasilAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Hasil::with('formulir.user');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('formulir', function ($q) use ($search) {
                $q->where('nama_aplikasi', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $hasil = $query->paginate(10);

        // Get formulir yang sudah selesai tapi belum ada hasilnya untuk dropdown create
        $formulirSelesai = Formulir::with('user')
            ->where('status', 'selesai')
            ->whereNotIn('id', Hasil::pluck('formulir_id'))
            ->get();

        return view('admin.hasil', compact('hasil', 'formulirSelesai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'formulir_id' => 'required|exists:formulir,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string',
            'tautan' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if formulir status is 'selesai'
        $formulir = Formulir::findOrFail($request->formulir_id);
        if ($formulir->status !== 'selesai') {
            return redirect()->back()->with('error', 'Hanya formulir dengan status "selesai" yang dapat dibuatkan hasil.');
        }

        // Check if hasil already exists for this formulir
        $existingHasil = Hasil::where('formulir_id', $request->formulir_id)->first();
        if ($existingHasil) {
            return redirect()->back()->with('error', 'Hasil untuk formulir ini sudah ada.');
        }

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('hasil-images', 'public');
            $data['image'] = $imagePath;
        }

        Hasil::create($data);

        return redirect()->route('admin.hasil.index')->with('success', 'Hasil berhasil dibuat!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hasil $hasil)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string',
            'tautan' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($hasil->image) {
                Storage::disk('public')->delete($hasil->image);
            }
            
            $imagePath = $request->file('image')->store('hasil-images', 'public');
            $data['image'] = $imagePath;
        }

        $hasil->update($data);

        return redirect()->route('admin.hasil.index')->with('success', 'Hasil berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hasil $hasil)
    {
        // Hapus gambar jika ada
        if ($hasil->image) {
            Storage::disk('public')->delete($hasil->image);
        }

        $hasil->delete();

        return redirect()->route('admin.hasil.index')
                        ->with('success', 'Hasil berhasil dihapus!');
    }
}