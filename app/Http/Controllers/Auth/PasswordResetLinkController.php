<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Validation\ValidationException;
   use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordManualMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

public function store(Request $request): RedirectResponse
{
    $request->validate([
        'email' => ['required', 'email'],
    ]);

    $user = User::where('email', $request->email)
                ->where('status', User::STATUS_APPROVED)
                ->first();

    if (!$user) {
        return back()->withErrors([
            'email' => 'Email tidak ditemukan atau akun belum disetujui.',
        ]);
    }

    $token = Str::random(64);

    DB::table('password_resets')->updateOrInsert(
        ['email' => $user->email],
        [
            'token' => Hash::make($token), // pakai hash seperti default Laravel
            'created_at' => Carbon::now(),
        ]
    );

    Mail::to($user->email)->send(new ResetPasswordManualMail($user, $token));

    return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
}
}
