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

            <!-- Right Panel - Password Reset Form -->
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
                <div class="mb-6 relative">
                    <h2 class="text-3xl font-bold text-slate-900 mb-2">Atur Ulang Password</h2>
                    <p class="text-gray-600">Masukkan email dan password baru Anda</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4 p-4 bg-blue-100 border-l-4 border-blue-500 text-blue-800 rounded" :status="session('status')" />

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-800 mb-2">
                            Email
                        </label>
                        <input 
                            id="email" 
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-300 rounded-lg text-slate-800 placeholder-gray-500 focus:outline-none focus:border-[#016DAE] focus:bg-white focus:ring-4 focus:ring-[#016DAE]/10 transition-all duration-300" 
                            type="email" 
                            name="email" 
                            value="{{ old('email', $request->email) }}" 
                            required 
                            autofocus
                            autocomplete="username"
                            placeholder="email@contoh.com"
                        />
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <label for="password" class="block text-sm font-medium text-slate-800 mb-2">
                            Password Baru
                        </label>
                        <input 
                            id="password" 
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-300 rounded-lg text-slate-800 placeholder-gray-500 focus:outline-none focus:border-[#016DAE] focus:bg-white focus:ring-4 focus:ring-[#016DAE]/10 transition-all duration-300 pr-10" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="new-password"
                            placeholder="Password baru"
                        />
                        <!-- Eye toggle -->
                        <button type="button" onclick="togglePassword()" id="togglePasswordBtn"
                            class="absolute right-3 top-11 text-gray-500 hover:text-[#016DAE] focus:outline-none">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Confirm Password -->
                    <div class="relative">
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-800 mb-2">
                            Konfirmasi Password Baru
                        </label>
                        <input 
                            id="password_confirmation" 
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-300 rounded-lg text-slate-800 placeholder-gray-500 focus:outline-none focus:border-[#016DAE] focus:bg-white focus:ring-4 focus:ring-[#016DAE]/10 transition-all duration-300 pr-10" 
                            type="password" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            placeholder="Ulangi password baru"
                        />
                        <!-- Eye toggle -->
                        <button type="button" onclick="togglePasswordConfirmation()" id="togglePasswordConfirmationBtn"
                            class="absolute right-3 top-11 text-gray-500 hover:text-[#016DAE] focus:outline-none">
                            <svg id="eyeIconConfirmation" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center justify-between">
                        <a 
                            href="{{ route('login') }}" 
                            class="text-sm text-gray-600 hover:text-[#016DAE] transition-colors duration-300"
                        >
                            Kembali ke halaman login
                        </a>
                        
                        <button 
                            type="submit" 
                            class="bg-gradient-to-r from-[#016DAE] to-[#00ADE5] hover:from-[#00ADE5] hover:to-[#016DAE] text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-[#016DAE]/30"
                        >
                            Atur Ulang Password
                        </button>
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
        // Auto-dismiss alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.bg-blue-100, .bg-red-100').forEach(el => {
                el.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                setTimeout(() => el.remove(), 500);
            });
        }, 5000);

        function togglePassword() {
            const input = document.getElementById("password");
            const icon = document.getElementById("eyeIcon");

            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.054 10.054 0 012.158-3.114M6.1 6.1a9.953 9.953 0 0111.8 0m2.04 2.04A10.053 10.053 0 0121.542 12c-1.274 4.057-5.064 7-9.542 7-1.057 0-2.074-.163-3.025-.464M3 3l18 18"/>`;
            } else {
                input.type = "password";
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
            }
        }

        function togglePasswordConfirmation() {
            const input = document.getElementById("password_confirmation");
            const icon = document.getElementById("eyeIconConfirmation");

            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.054 10.054 0 012.158-3.114M6.1 6.1a9.953 9.953 0 0111.8 0m2.04 2.04A10.053 10.053 0 0121.542 12c-1.274 4.057-5.064 7-9.542 7-1.057 0-2.074-.163-3.025-.464M3 3l18 18"/>`;
            } else {
                input.type = "password";
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
            }
        }

        // Show/hide eye icons based on input content
        document.getElementById("password").addEventListener("input", function() {
            const btn = document.getElementById("togglePasswordBtn");
            btn.style.display = this.value.length > 0 ? "block" : "none";
        });

        document.getElementById("password_confirmation").addEventListener("input", function() {
            const btn = document.getElementById("togglePasswordConfirmationBtn");
            btn.style.display = this.value.length > 0 ? "block" : "none";
        });
    </script>
</x-guest-layout>