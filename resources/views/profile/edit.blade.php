<div class="min-h-screen bg-[#E0F7FE] relative">
    <!-- Subtle Background Elements -->
    <div class="fixed inset-0 pointer-events-none opacity-30">
        <div class="absolute top-10 left-10 w-80 h-80 bg-gradient-to-br from-blue-300/20 to-cyan-300/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-72 h-72 bg-gradient-to-br from-blue-400/15 to-[#016DAE]/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/4 w-56 h-56 bg-gradient-to-br from-[#00ADE5]/15 to-blue-300/10 rounded-full blur-3xl animate-pulse delay-2000"></div>
        <div class="absolute top-1/4 right-1/3 w-64 h-64 bg-gradient-to-br from-cyan-300/15 to-blue-200/10 rounded-full blur-3xl animate-pulse delay-500"></div>
    </div>

    <x-app-layout>
        <!-- Enhanced Header Section -->
        <div class="relative overflow-hidden">
            <div class="h-56 bg-gradient-to-r from-[#016DAE] via-[#0284C7] to-[#00ADE5] shadow-2xl">
                <div class="absolute inset-0 bg-gradient-to-r from-black/20 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent"></div>
                <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.08"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
                
                <!-- Floating geometric shapes -->
                <div class="absolute top-8 left-8 w-16 h-16 bg-white/10 rounded-lg rotate-12 animate-float"></div>
                <div class="absolute top-16 right-16 w-12 h-12 bg-white/10 rounded-full animate-float delay-300"></div>
                <div class="absolute bottom-8 left-1/4 w-20 h-20 bg-white/10 rounded-lg rotate-45 animate-float delay-700"></div>
            </div>
        </div>

        <!-- Profile Section -->
        <div class="relative -mt-28 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Profile Header Card -->
                <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl border border-white/60 overflow-hidden mb-10 hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-1">
                    <div class="px-10 py-10">
                        <div class="flex flex-col lg:flex-row items-center lg:items-start space-y-8 lg:space-y-0 lg:space-x-10">
                            
                            <!-- Profile Photo -->
                            <div class="relative group shrink-0">
                                <div class="w-36 h-36 rounded-full border-4 border-white shadow-xl bg-gradient-to-br from-[#016DAE]/10 to-[#00ADE5]/10 overflow-hidden transition-all duration-300 group-hover:scale-105">
                                    <img src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}?s=256&d=mp" 
                                         alt="Profile Photo"
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 bg-black/50 rounded-full backdrop-blur-sm">
                                    <button class="text-white text-sm bg-white/20 backdrop-blur-md px-5 py-2.5 rounded-full flex items-center border border-white/40 hover:bg-white/30 transition-all duration-200 transform hover:scale-105">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                        </svg>
                                        Ubah Foto
                                    </button>
                                </div>
                                
                                <!-- Online Status Indicator -->
                                <div class="absolute -bottom-2 -right-2 w-6 h-6 bg-green-500 rounded-full border-3 border-white shadow-lg animate-pulse"></div>
                            </div>

                            <!-- User Info -->
                            <div class="flex-1 text-center lg:text-left">
                                <div class="space-y-4">
                                    <div>
                                        <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ auth()->user()->name }}</h1>
                                        <p class="text-gray-600 text-xl">Pengguna Terdaftar</p>
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start space-y-3 sm:space-y-0 sm:space-x-8 text-gray-600">
                                        <div class="flex items-center bg-blue-50/50 px-4 py-2 rounded-full transition-all duration-200 hover:bg-blue-100/50">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#00ADE5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="font-medium">{{ auth()->user()->email }}</span>
                                        </div>
                                        <div class="flex items-center bg-blue-50/50 px-4 py-2 rounded-full transition-all duration-200 hover:bg-blue-100/50">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#016DAE]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="font-medium">Bergabung {{ auth()->user()->created_at->format('d M Y') }}</span>
                                        </div>
                                    </div>

                                    <div class="flex justify-center lg:justify-start">
                                        <span class="bg-gradient-to-r from-green-500/20 to-emerald-500/20 backdrop-blur-sm text-green-700 px-6 py-3 rounded-full text-sm font-semibold flex items-center border border-green-200/60 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Akun Terverifikasi
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->

                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                    
                    <!-- Left Column - Profile Forms -->
                    <div class="lg:col-span-3 space-y-8">
                        
                        <!-- Profile Information -->
                        <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-xl border border-white/60 overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1">
                            <div class="px-10 py-8 border-b border-gray-100/80 bg-gradient-to-r from-blue-50/70 to-transparent">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-14 h-14 bg-gradient-to-br from-[#016DAE]/15 to-[#00ADE5]/15 rounded-2xl flex items-center justify-center mr-5 shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#016DAE]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-2xl font-bold text-gray-800">Informasi Profil</h3>
                                            <p class="text-gray-600 mt-1 text-lg">Kelola informasi pribadi Anda</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="text-sm text-gray-500 bg-gray-100/80 px-4 py-2 rounded-full font-medium">Terakhir diperbarui: 3 hari lalu</span>
                                        <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-10">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>

                        <!-- Account Security -->
                        <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-xl border border-white/60 overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1">
                            <div class="px-10 py-8 border-b border-gray-100/80 bg-gradient-to-r from-indigo-50/70 to-transparent">
                                <div class="flex items-center">
                                    <div class="w-14 h-14 bg-gradient-to-br from-[#00ADE5]/15 to-indigo-500/15 rounded-2xl flex items-center justify-center mr-5 shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#00ADE5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-800">Keamanan Akun</h3>
                                        <p class="text-gray-600 mt-1 text-lg">Perbarui kata sandi untuk menjaga keamanan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="p-10">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>

                        <!-- Delete Account -->
                        <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-xl border border-red-200/60 overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1">
                            <div class="px-10 py-8 border-b border-red-100/80 bg-gradient-to-r from-red-50/70 to-transparent">
                                <div class="flex items-center">
                                    <div class="w-14 h-14 bg-gradient-to-br from-red-500/15 to-red-600/15 rounded-2xl flex items-center justify-center mr-5 shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-red-600">Hapus Akun</h3>
                                        <p class="text-red-500 mt-1 text-lg">Tindakan ini tidak dapat dibatalkan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="p-10 bg-red-50/50">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Additional Info -->
                    <div class="space-y-8">
                        
                        <!-- Quick Stats -->
                        <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-xl border border-white/60 p-8 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1">
                            <h4 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-[#016DAE]/15 to-[#00ADE5]/15 rounded-lg flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#016DAE]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                Statistik Akun
                            </h4>
                            <div class="space-y-5">
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50/70 to-blue-100/30 rounded-2xl border border-blue-200/30 hover:from-blue-100/70 hover:to-blue-150/30 transition-all duration-200">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-[#016DAE]/15 rounded-xl flex items-center justify-center mr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#016DAE]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">Terakhir Login</span>
                                    </div>
                                    <span class="text-sm font-bold text-gray-800">2 jam lalu</span>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-green-50/70 to-green-100/30 rounded-2xl border border-green-200/30 hover:from-green-100/70 hover:to-green-150/30 transition-all duration-200">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-green-500/15 rounded-xl flex items-center justify-center mr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">Status Akun</span>
                                    </div>
                                    <span class="text-sm font-bold text-green-600">Aktif</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</div>

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-10px) rotate(3deg); }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

.animate-float.delay-300 {
    animation-delay: 300ms;
}

.animate-float.delay-700 {
    animation-delay: 700ms;
}
</style>