<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

   public function handleGoogleCallback()
    {
/** @var \Laravel\Socialite\Two\GoogleProvider $provider */
    $provider = Socialite::driver('google');

    $googleUser = $provider
        ->stateless()
        ->with([
            'prompt' => 'select_account',
            'access_type' => 'offline',
        ])
        ->user();




    $user = User::where('email', $googleUser->getEmail())->first();

    if (!$user) {
        // daftar baru
        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt(Str::random(16)),
            'status' => 'diproses',
        ]);

        return redirect()->route('login')->with('status', 'Pendaftaran berhasil. Silakan cek email Anda setelah akun disetujui oleh administrator.');
    }


    // Jika status belum disetujui → jangan login
    if ($user->status === 'diproses') {
        return redirect()->route('login')->with('warning', 'Akun Anda sedang diproses. Silakan tunggu verifikasi administrator.');
    }

    if ($user->status === 'ditolak') {
        return redirect()->route('login')->with('error', 'Akun Anda telah ditolak. Silakan hubungi administrator.');
    }

    // Jika disetujui → login
    Auth::login($user);
    return redirect()->intended('dashboard');
}


}
