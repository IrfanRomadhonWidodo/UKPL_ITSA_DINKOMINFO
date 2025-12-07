<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserApprovedMail;
use App\Mail\UserRejectedMail;

class UserAdminController extends Controller
{
    /**
     * Menampilkan daftar pengguna dengan fungsionalitas pencarian.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Pencarian berdasarkan nama, email
        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                ->orWhere('email', 'like', $searchTerm);
            });
        }

        // Filter berdasarkan status (dari dropdown)
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $users = $query->latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    /**
     * Menyimpan pengguna baru ke dalam database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:user,admin'],
            'status' => ['required', 'in:diproses,disetujui,ditolak'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Memperbarui data pengguna yang ada.
     */
    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
        'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        'role' => ['required', 'in:user,admin'],
        'status' => ['required', 'in:diproses,disetujui,ditolak'],
    ]);

    // Simpan status lama sebelum update
    $oldStatus = $user->status;

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'status' => $request->status,
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    //EMAIL NOTIFICATION Kirim email jika status berubah ke disetujui atau ditolak
    if ($oldStatus !== $request->status) {
        if ($request->status === 'disetujui') {
            Mail::to($user->email)->send(new UserApprovedMail($user));
        } elseif ($request->status === 'ditolak') {
            Mail::to($user->email)->send(new UserRejectedMail($user));
        }
    }

    return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate.');
}


    /**
     * Menghapus pengguna dari database.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
    
}