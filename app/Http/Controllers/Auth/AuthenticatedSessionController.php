<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    $credentials = $request->only('email', 'password');

    // Coba login tanpa langsung login (gunakan attempt)
    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->status === 'ditolak') {
            Auth::logout();
            return back()->with('error', 'Akun Anda telah ditolak. Silakan hubungi administrator.');
        }

        if ($user->status === 'diproses') {
            Auth::logout();
            return back()->with('warning', 'Akun Anda sedang diproses. Silakan tunggu verifikasi administrator.');
        }

        // Hanya jika status disetujui
        $request->session()->regenerate();
        return redirect()->intended(route('dashboard', absolute: false));
    }

    // Kalau login gagal
    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->status === 'ditolak') {
            Auth::logout();
            return back()->with('error', 'Akun Anda telah ditolak. Silakan hubungi administrator.');
        }

        if ($user->status === 'diproses') {
            Auth::logout();
            return back()->with('warning', 'Akun Anda sedang diproses. Silakan tunggu verifikasi administrator.');
        }

        // Jika status disetujui, lanjutkan ke dashboard
        return redirect()->intended(route('dashboard'));
    }

    public function rules(): array
{
    return [
        'email' => ['required', 'string', 'email'],
        'password' => ['required', 'string'],
        // 'g-recaptcha-response' => ['required', 'captcha'],
    ];
}

}
