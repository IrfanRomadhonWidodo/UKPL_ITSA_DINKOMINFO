<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-800 to-[#016DAE] relative overflow-hidden">
        <!-- Decorative background elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-20 -left-20 w-40 h-40 bg-[#00ADE5] rounded-full opacity-20"></div>
            <div class="absolute -bottom-32 -right-32 w-64 h-64 bg-gray-300 rounded-full opacity-10"></div>
            <div class="absolute top-1/2 -left-16 w-32 h-32 bg-[#016DAE] rounded-full opacity-15"></div>
        </div>

        <div class="relative z-10 flex bg-white/95 backdrop-blur-sm overflow-hidden min-h-screen">
            <!-- Left Panel - Logo & Branding -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-[#016DAE] to-[#00ADE5] p-12 flex-col justify-center items-center text-white relative">
                <!-- Floating elements -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute top-1/4 left-1/4 w-16 h-16 bg-white/10 rounded-full animate-float"></div>
                <div class="absolute bottom-1/3 right-1/4 w-12 h-12 bg-white/5 rounded-full animate-float-slow"></div>
                <div class="absolute top-2/3 left-1/6 w-20 h-20 bg-white/5 rounded-full animate-float delay-1000"></div>
            </div>


        <div class="text-center z-10 animate-fadeInUp">
                    <!-- Logo -->
                    <div class="mb-8">
                        <div class="w-32 h-32 bg-white/20 rounded-full mx-auto mb-6 flex items-center justify-center shadow-xl backdrop-blur-sm">
                            <img src="{{ asset('image/logo_banyumas.png') }}" alt="Logo Banyumas" class="w-24 h-24 object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="hidden w-24 h-24 bg-[#EDBC19] rounded-full items-center justify-center text-white text-2xl font-bold">
                                🏛️
                            </div>
                        </div>
                    </div>

                    <!-- Brand Text -->
                    <h1 class="text-4xl font-bold mb-4 drop-shadow-lg">
                        Dinkominfo
                    </h1>
                    <p class="text-2xl font-light opacity-90">
                        Kab. Banyumas
                    </p>
                    
                    <!-- Subtitle -->
                    <div class="mt-8 p-4 bg-white/10 rounded-lg backdrop-blur-sm">
                        <p class="text-sm opacity-80">
                            Information Technology Security Assessment
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Login Form -->
            <div class="w-full lg:w-1/2 p-8 lg:p-12 flex flex-col justify-center">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8">
                    <div class="w-20 h-20 bg-gray-300 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <img src="{{ asset('image/logo_banyumas.png') }}" alt="Logo Banyumas" class="w-16 h-16 object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="hidden w-16 h-16 bg-[#016DAE] rounded-full items-center justify-center text-white text-lg">
                            🏛️
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800">Dinkominfo Kab. Banyumas</h2>
                </div>

                <!-- Header -->
                <div class="mb-4 relative">
                    <h2 class="text-3xl font-bold text-slate-900 mb-2">Login</h2>
                    <p class="text-gray-600">Masuk untuk mengakses layanan ITSA Dinkominfo</p>
                    <!-- Floating Info Box -->
                    <div class="absolute -top-2 right-0">
                        <div class="relative group">
                            <button class="text-blue-500 hover:text-blue-600">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <div class="hidden group-hover:block absolute right-0 mt-2 w-64 bg-white p-3 rounded-lg shadow-lg border border-gray-200 z-10">
                                <p class="text-sm text-gray-700 font-medium">Info Login</p>
                                <p class="text-xs text-gray-600 mt-1">Pastikan akun Anda telah disetujui oleh admin sebelum login.</p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Session Status -->

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email Address -->
                    <div>
                            <!-- Custom Status Messages -->
                        @if (session('warning'))
                            <div class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 rounded auto-dismiss">
                                <p>{{ session('warning') }}</p>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded auto-dismiss">
                                <p>{{ session('error') }}</p>
                            </div>
                        @endif
                            @if (session('status'))
                            <div class="mb-4 p-4 bg-blue-100 border-l-4 border-blue-500 text-blue-800 rounded auto-dismiss">
                                <p>{{ session('status') }}</p>
                            </div>
                        @endif

                        <label for="email" class="block text-sm font-medium text-slate-800 mb-2">
                            Email
                        </label>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus 
                            autocomplete="username"
                            {{-- placeholder="contoh@gmail.com" --}}
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-300 rounded-lg text-slate-800 placeholder-gray-500 focus:outline-none focus:border-[#016DAE] focus:bg-white focus:ring-4 focus:ring-[#016DAE]/10 transition-all duration-300"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <label for="password" class="block text-sm font-medium text-slate-800 mb-2">
                            Kata Sandi
                        </label>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            required 
                            autocomplete="current-password"
                            {{-- placeholder="••••••" --}}
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-300 rounded-lg text-slate-800 placeholder-gray-500 focus:outline-none focus:border-[#016DAE] focus:bg-white focus:ring-4 focus:ring-[#016DAE]/10 transition-all duration-300 pr-10"
                        />
                        <!-- Eye toggle -->
                        <button type="button" onclick="togglePassword()" id="togglePasswordBtn"
                            class="absolute right-3 top-11 text-gray-500 hover:text-[#016DAE] focus:outline-none hidden">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>

                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input 
                            id="remember_me" 
                            name="remember" 
                            type="checkbox" 
                            class="w-4 h-4 text-[#016DAE] bg-gray-100 border-gray-300 rounded focus:ring-[#016DAE] focus:ring-2"
                        >
                        <label for="remember_me" class="ml-3 text-sm text-gray-600">
                            {{ __('Remember me') }}
                        </label>
                    </div>
                    {{-- <div class="mt-4">
                        <div style="max-width: 120px;">
                            <div class="g-recaptcha" data-sitekey="6Lcpdo4rAAAAAO6qY7hXk4cjdxW5IMk7xnKfstN4"></div>
                        </div>
                        @error('g-recaptcha-response')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div> --}}
                    <!-- Submit Button -->
                    <div class="mt-6">
                        <a href="{{ route('google.login') }}"
                            class="w-full inline-flex justify-center items-center px-6 py-3 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-all duration-300">
                            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" class="w-5 h-5 mr-3">
                            Masuk dengan Google
                        </a>
                    </div>
                    <div>
                        <button 
                            type="submit" 
                            class="w-full bg-gradient-to-r from-[#016DAE] to-[#00ADE5] hover:from-[#00ADE5] hover:to-[#016DAE] text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-[#016DAE]/30"
                        >
                            Masuk
                        </button>
                    </div>

                    <!-- Forgot Password -->
                    <div class="text-center">
                        @if (Route::has('password.request'))
                            <a 
                                href="{{ route('password.request') }}" 
                                class="text-sm text-gray-600 hover:text-[#016DAE] transition-colors duration-300"
                            >
                                Lupa kata sandi?
                            </a>
                        @endif
                    </div>

                    <!-- Register Link -->
                    <div class="text-center">
                        @if (Route::has('register'))
                            <p class="text-sm text-gray-600">
                                Belum punya akun?  
                                <a 
                                    href="{{ route('register') }}" 
                                    class="text-[#016DAE] hover:text-[#00ADE5] font-medium transition-colors duration-300"
                                >
                                    Daftar di sini
                                </a>
                            </p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    @keyframes fadeInUp {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .animate-float-slow {
        animation: float 10s ease-in-out infinite;
    }

    .animate-fadeInUp {
        animation: fadeInUp 1s ease-out forwards;
    }

    .delay-1000 {
        animation-delay: 1s;
    }
</style>

<script>
    // Setelah 5 detik, sembunyikan alert (jika ada)
    setTimeout(() => {
        document.querySelectorAll('.auto-dismiss').forEach(el => {
            el.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            setTimeout(() => el.remove(), 500); // hapus dari DOM setelah fade-out
        });
    }, 5000);

    function togglePassword() {
        const input = document.getElementById("password");
        const icon = document.getElementById("eyeIcon");

        if (input.type === "password") {
            input.type = "text";
            icon.outerHTML = `<svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.054 10.054 0 012.158-3.114M6.1 6.1a9.953 9.953 0 0111.8 0m2.04 2.04A10.053 10.053 0 0121.542 12c-1.274 4.057-5.064 7-9.542 7-1.057 0-2.074-.163-3.025-.464M3 3l18 18"/>
                </svg>`;
        } else {
            input.type = "password";
            icon.outerHTML = `<svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>`;
        }
    }

    function togglePasswordConfirmation() {
        const input = document.getElementById("password_confirmation");
        const icon = document.getElementById("eyeIconConfirmation");

        if (input.type === "password") {
            input.type = "text";
            icon.outerHTML = `<svg id="eyeIconConfirmation" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.054 10.054 0 012.158-3.114M6.1 6.1a9.953 9.953 0 0111.8 0m2.04 2.04A10.053 10.053 0 0121.542 12c-1.274 4.057-5.064 7-9.542 7-1.057 0-2.074-.163-3.025-.464M3 3l18 18"/>
                </svg>`;
        } else {
            input.type = "password";
            icon.outerHTML = `<svg id="eyeIconConfirmation" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>`;
        }
    }

    // Tampilkan icon saat input tidak kosong
    document.getElementById("password").addEventListener("input", function () {
        const btn = document.getElementById("togglePasswordBtn");
        if (this.value.length > 0) {
            btn.classList.remove("hidden");
        } else {
            btn.classList.add("hidden");
        }
    });

    document.getElementById("password_confirmation").addEventListener("input", function () {
        const btn = document.getElementById("togglePasswordConfirmationBtn");
        if (this.value.length > 0) {
            btn.classList.remove("hidden");
        } else {
            btn.classList.add("hidden");
        }
    });
</script>



</x-guest-layout>