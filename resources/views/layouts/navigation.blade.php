<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-lg rounded-b-2xl">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo Section -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                    <div class="relative">
                        <img src="{{ asset('image/logo_banyumas.png') }}" alt="Logo Banyumas" 
                             class="h-14 w-14 object-contain transition-transform duration-300">
                    </div>
                    <div class="flex flex-col leading-tight">
                        <span class="text-lg font-extrabold text-blue-900 tracking-wide transition-colors duration-300 ">
                            DINKOMINFO
                        </span>
                        <span class="text-sm text-[#00ADE5] font-semibold -mt-1">
                            KAB. BANYUMAS
                        </span>
                    </div>
                </a>
            </div>

            <!-- Center Navigation Links (Desktop) -->
            @auth
            <div class="hidden md:flex items-center justify-center flex-1">
                <nav class="flex items-center space-x-8">
                    <!-- Beranda -->
                    <a href="{{ route('dashboard') }}" 
                       class="relative px-4 py-2 text-sm font-semibold transition-all duration-300 rounded-lg group
                              {{ request()->routeIs('dashboard') 
                                 ? 'text-[#016DAE] bg-[#00ADE5]/10' 
                                 : 'text-gray-600 hover:text-[#016DAE] hover:bg-[#00ADE5]/5' }}">
                        <span class="relative z-10">{{ __('Beranda') }}</span>
                        @if(request()->routeIs('dashboard'))
                        <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-[#00ADE5] to-[#016DAE] rounded-full"></div>
                        @endif
                    </a>

                    <!-- Layanan (Dropdown) -->
                    @php
                        $layananActive = request()->is('alur*') || request()->is('formulir*') || request()->is('riwayat*') || request()->is('download');
                    @endphp
                    <div class="relative group" x-data="{ layananDropdown: false }">
                        <button @mouseenter="layananDropdown = true" 
                                @mouseleave="layananDropdown = false"
                                class="relative px-4 py-2 text-sm font-semibold transition-all duration-300 rounded-lg flex items-center space-x-1
                                       {{ $layananActive 
                                          ? 'text-[#016DAE] bg-[#00ADE5]/10' 
                                          : 'text-gray-600 hover:text-[#016DAE] hover:bg-[#00ADE5]/5' }}">
                            <span>Layanan</span>
                            <svg class="w-4 h-4 transition-transform duration-300" 
                                 :class="{ 'rotate-180': layananDropdown }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                            @if($layananActive)
                            <div class="absolute bottom-0 left-0 right-1 h-0.5 bg-gradient-to-r from-[#00ADE5] to-[#016DAE] rounded-full"></div>
                            @endif
                        </button>
                        
                        <div x-show="layananDropdown" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             @mouseenter="layananDropdown = true" 
                             @mouseleave="layananDropdown = false"
                             class="absolute top-full left-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50 overflow-hidden">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#00ADE5] to-[#016DAE]"></div>
                            <a href="{{ route('alur-layanan') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-[#00ADE5]/5 hover:text-[#016DAE] transition-all duration-200 group">
                                <div class="w-2 h-2 rounded-full bg-[#00ADE5] mr-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                <span class="font-medium">Alur Layanan</span>
                            <a href="{{ route('formulir.index') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-[#00ADE5]/5 hover:text-[#016DAE] transition-all duration-200 group">
                                <div class="w-2 h-2 rounded-full bg-[#00ADE5] mr-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                <span class="font-medium">Formulir</span>
                            </a>
                            <a href="{{ route('riwayat.index') }}"
                            class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-[#00ADE5]/5 hover:text-[#016DAE] transition-all duration-200 group">
                                <div class="w-2 h-2 rounded-full bg-[#00ADE5] mr-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                <span class="font-medium">Riwayat</span>
                            </a>
                            <a href="{{ route('download') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-[#00ADE5]/5 hover:text-[#016DAE] transition-all duration-200 group">
                                <div class="w-2 h-2 rounded-full bg-[#00ADE5] mr-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                <span class="font-medium">Dokumen S&K</span>
                            </a>
                        </div>
                    </div>

                    <!-- Tentang ITSA (Dropdown) -->
                    @php
                        $tentangActive = request()->routeIs('profil-itsa') || request()->routeIs('panduan') || request()->routeIs('faq');
                    @endphp
                    <div class="relative group" x-data="{ tentangDropdown: false }">
                        <button @mouseenter="tentangDropdown = true"
                                @mouseleave="tentangDropdown = false"
                                class="relative px-4 py-2 text-sm font-semibold transition-all duration-300 rounded-lg flex items-center space-x-1
                                    {{ $tentangActive 
                                        ? 'text-[#016DAE] bg-[#00ADE5]/10' 
                                        : 'text-gray-600 hover:text-[#016DAE] hover:bg-[#00ADE5]/5' }}">
                            <span>Tentang ITSA</span>
                            <svg class="w-4 h-4 transition-transform duration-300" 
                                :class="{ 'rotate-180': tentangDropdown }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                            @if($tentangActive)
                            <div class="absolute bottom-0 left-0 right-1 h-0.5 bg-gradient-to-r from-[#00ADE5] to-[#016DAE] rounded-full"></div>
                            @endif
                        </button>

                        <div x-show="tentangDropdown" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            @mouseenter="tentangDropdown = true" 
                            @mouseleave="tentangDropdown = false"
                            class="absolute top-full left-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50 overflow-hidden">
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#00ADE5] to-[#016DAE]"></div>

                            <a href="{{ route('profil-itsa') }}" 
                            class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-[#00ADE5]/5 hover:text-[#016DAE] transition-all duration-200 group">
                                <div class="w-2 h-2 rounded-full bg-[#00ADE5] mr-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                <span class="font-medium">Profil ITSA</span>
                            </a>

                            <a href="{{ route('panduan') }}" 
                            class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-[#00ADE5]/5 hover:text-[#016DAE] transition-all duration-200 group">
                                <div class="w-2 h-2 rounded-full bg-[#00ADE5] mr-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                <span class="font-medium">Panduan Penggunaan</span>
                            </a>

                            <a href="{{ route('faq') }}" 
                            class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-[#00ADE5]/5 hover:text-[#016DAE] transition-all duration-200 group">
                                <div class="w-2 h-2 rounded-full bg-[#00ADE5] mr-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                <span class="font-medium">FAQ</span>
                            </a>
                        </div>
                    </div>


                    <!-- Kontak -->
                    <a href="{{ route('kontak') }}" 
                       class="relative px-4 py-2 text-sm font-semibold transition-all duration-300 rounded-lg group
                              {{ request()->routeIs('kontak') 
                                 ? 'text-[#016DAE] bg-[#00ADE5]/10' 
                                 : 'text-gray-600 hover:text-[#016DAE] hover:bg-[#00ADE5]/5' }}">
                        <span class="relative z-10">{{ __('Kontak') }}</span>
                        @if(request()->routeIs('kontak'))
                        <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-[#00ADE5] to-[#016DAE] rounded-full"></div>
                        @endif
                    </a>
                </nav>
            </div>
            @endauth

            <!-- Right Side - User Menu -->
            <div class="flex items-center space-x-4">
                @auth
            <!-- Notifikasi (Lonceng dengan badge counter) -->
            <a href="{{ route('notifikasi.index') }}" class="relative text-gray-600 hover:text-blue-700 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-5-5.917V5a1 1 0 10-2 0v.083A6.002 6.002 0 006 11v3.159c0 .538-.214 1.055-.595 1.437L4 17h5m6 0v1a3 3 0 11-6 0v-1h6z" />
                </svg>
                
                <!-- Badge counter untuk notifikasi belum dibaca -->
                @if(auth()->user()->unread_notifications_count > 0)
                    <span class="absolute -top-2 -right-2 inline-flex items-center justify-center w-5 h-5 text-xs font-bold leading-none text-white bg-red-500 rounded-full animate-pulse">
                        {{ auth()->user()->unread_notifications_count > 99 ? '99+' : auth()->user()->unread_notifications_count }}
                    </span>
                @endif
            </a>
                <!-- User Dropdown -->
                <div class="hidden sm:block">
                    <x-dropdown align="right" width="72">
                        <x-slot name="trigger">
                            <button class="flex items-center space-x-3 px-4 py-2 rounded-xl text-sm font-medium text-gray-700 bg-gray-50 hover:bg-[#00ADE5]/10 hover:text-[#016DAE] focus:outline-none focus:ring-2 focus:ring-[#00ADE5]/50 transition-all duration-300 group">
                                <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(Auth::user()->email))) }}?s=40&d=mp&r=g" 
                                     alt="{{ Auth::user()->name }}" 
                                     class="h-8 w-8 rounded-full border-2 border-white shadow-sm group-hover:border-[#00ADE5]/50 transition-all duration-300">
                                <!-- User role -->
                                <div class="hidden lg:block text-left">
                                    <div class="font-semibold text-gray-900">{{ Str::limit(Auth::user()->name, 15) }}</div>
                                    
                                    @if(Auth::user()->role === 'admin')
                                        <div class="text-xs text-gray-500">Admin</div>
                                    @endif
                                </div>

                                <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-gradient-to-r from-[#00ADE5] to-[#016DAE] p-4 text-white">
                                <div class="flex items-center space-x-3">
                                    <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(Auth::user()->email))) }}?s=48&d=mp&r=g" 
                                         alt="{{ Auth::user()->name }}" 
                                         class="h-12 w-12 rounded-full border-2 border-white/50">
                                    <div class="min-w-0 flex-1">
                                        <div class="font-semibold truncate">{{ Auth::user()->name }}</div>
                                        <div class="text-sm opacity-90 truncate">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="py-2">
                                <x-dropdown-link :href="route('profile.edit')" 
                                                class="flex items-center px-4 py-3 hover:bg-[#00ADE5]/5 hover:text-[#016DAE] transition-all duration-200 group">
                                    <svg class="w-4 h-4 mr-3 opacity-60 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                @auth
                                    @if(auth()->user()->role === 'admin')
                                        <div class="border-t border-gray-100 my-1"></div>
                                        <x-dropdown-link href="{{ route('admin.dashboard') }}" 
                                                        class="flex items-center px-4 py-3 hover:bg-yellow-100 hover:text-yellow-600 transition-all duration-200 group">
                                            <svg class="w-4 h-4 mr-3 opacity-60 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z
                                                        M14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z
                                                        M4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2z
                                                        M14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                                </path>
                                            </svg>
                                            {{ __('Dashboard Admin') }}
                                        </x-dropdown-link>
                                    @endif
                                @endauth


                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                                    class="flex items-center px-4 py-3 hover:bg-red-50 hover:text-red-600 transition-all duration-200 group">
                                        <svg class="w-4 h-4 mr-3 opacity-60 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
                @else
                <!-- Guest Links -->
                <div class="hidden sm:flex items-center space-x-3">
                    <a href="{{ route('login') }}" 
                       class="inline-flex items-center px-6 py-2.5 text-sm font-semibold rounded-lg border-2 border-[#00ADE5] text-[#016DAE] bg-white hover:bg-[#00ADE5] hover:text-white transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Login
                    </a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" 
                       class="inline-flex items-center px-6 py-2.5 text-sm font-semibold rounded-lg bg-gradient-to-r from-[#00ADE5] to-[#016DAE] text-white hover:shadow-lg transition-all duration-300 transform hover:scale-105 hover:from-[#016DAE] hover:to-[#00ADE5]">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Register
                    </a>
                    @endif
                </div>
                @endauth

                <!-- Mobile Hamburger Menu -->
                <button @click="open = !open" 
                        class="md:hidden inline-flex items-center justify-center p-2.5 rounded-lg text-gray-600 hover:text-[#016DAE] hover:bg-[#00ADE5]/10 focus:outline-none focus:ring-2 focus:ring-[#00ADE5]/50 transition-all duration-300">
                    <svg class="h-6 w-6 transition-transform duration-300" :class="{ 'rotate-90': open }" 
                         stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" 
                              class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" 
                              class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-2"
         class="hidden md:hidden bg-white border-t border-gray-200 shadow-lg">
        
        @auth
        <!-- Mobile Navigation Links -->
        <div class="px-4 py-6 space-y-2">
            <a href="{{ route('dashboard') }}" 
               class="flex items-center px-4 py-3 rounded-lg text-base font-medium transition-all duration-300
                      {{ request()->routeIs('dashboard') 
                         ? 'bg-gradient-to-r from-[#00ADE5]/20 to-[#016DAE]/20 text-[#016DAE] border-l-4 border-[#00ADE5]' 
                         : 'text-gray-700 hover:bg-[#00ADE5]/5 hover:text-[#016DAE]' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                {{ __('Beranda') }}
            </a>

            <!-- Mobile Layanan Dropdown -->
            <div x-data="{ mobileLayananOpen: false }">
                <button @click="mobileLayananOpen = !mobileLayananOpen"
                        class="flex items-center justify-between w-full px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:bg-[#00ADE5]/5 hover:text-[#016DAE] transition-all duration-300">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Layanan
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-300" :class="{ 'rotate-180': mobileLayananOpen }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                
                <div x-show="mobileLayananOpen" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 max-h-0"
                     x-transition:enter-end="opacity-100 max-h-48"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 max-h-48"
                     x-transition:leave-end="opacity-0 max-h-0"
                     class="ml-8 mt-2 space-y-1 overflow-hidden">
                    <a href="{{ route('alur-layanan') }}" class="flex items-center px-4 py-2 text-sm text-gray-600 hover:text-[#016DAE] hover:bg-[#00ADE5]/5 rounded-lg transition-all duration-200">
                        <div class="w-2 h-2 rounded-full bg-[#00ADE5] mr-3"></div>
                        Alur Layanan
                    </a>
                    <a href="{{ route('formulir.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-600 hover:text-[#016DAE] hover:bg-[#00ADE5]/5 rounded-lg transition-all duration-200">
                        <div class="w-2 h-2 rounded-full bg-[#00ADE5] mr-3"></div>
                        Formulir
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-600 hover:text-[#016DAE] hover:bg-[#00ADE5]/5 rounded-lg transition-all duration-200">
                        <div class="w-2 h-2 rounded-full bg-[#00ADE5] mr-3"></div>
                        Riwayat
                    </a>
                </div>
            </div>

            <!-- Mobile Tentang ITSA Dropdown -->
            <div x-data="{ mobileTentangOpen: false }">
                <button @click="mobileTentangOpen = !mobileTentangOpen"
                        class="flex items-center justify-between w-full px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:bg-[#00ADE5]/5 hover:text-[#016DAE] transition-all duration-300">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tentang ITSA
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-300" :class="{ 'rotate-180': mobileTentangOpen }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                
                <div x-show="mobileTentangOpen" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-48"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 max-h-48"
                    x-transition:leave-end="opacity-0 max-h-0"
                    class="ml-8 mt-2 space-y-1 overflow-hidden">
                    <a href="" class="flex items-center px-4 py-2 text-sm text-gray-600 hover:text-[#016DAE] hover:bg-[#00ADE5]/5 rounded-lg transition-all duration-200">
                        <div class="w-2 h-2 rounded-full bg-[#00ADE5] mr-3"></div>
                        Profil ITSA
                    </a>
                    <a href="" class="flex items-center px-4 py-2 text-sm text-gray-600 hover:text-[#016DAE] hover:bg-[#00ADE5]/5 rounded-lg transition-all duration-200">
                        <div class="w-2 h-2 rounded-full bg-[#00ADE5] mr-3"></div>
                        Panduan Penggunaan
                    </a>
                    <a href="" class="flex items-center px-4 py-2 text-sm text-gray-600 hover:text-[#016DAE] hover:bg-[#00ADE5]/5 rounded-lg transition-all duration-200">
                        <div class="w-2 h-2 rounded-full bg-[#00ADE5] mr-3"></div>
                        FAQ
                    </a>
                </div>
            </div>


            <a href="{{ route('kontak') }}" class="flex items-center px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:bg-[#00ADE5]/5 hover:text-[#016DAE] transition-all duration-300">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                {{ __('Kontak') }}
            </a>
        </div>

        <!-- Mobile User Section -->
        <div class="border-t border-gray-200 px-4 py-6">
            <div class="flex items-center space-x-4 mb-4">
                <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(Auth::user()->email))) }}?s=48&d=mp&r=g" 
                     alt="{{ Auth::user()->name }}" 
                     class="h-12 w-12 rounded-full border-2 border-[#00ADE5]/30">
                <div>
                    <div class="font-semibold text-base text-[#016DAE]">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-2">
                <a href="{{ route('profile.edit') }}" 
                   class="flex items-center px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:bg-[#00ADE5]/5 hover:text-[#016DAE] transition-all duration-300">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    {{ __('Profile') }}
                </a>
                <a href="#" 
                class="flex items-center px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:bg-yellow-100 hover:text-yellow-600 transition-all duration-300">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    {{ __('Dashboard Admin') }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="flex items-center w-full px-4 py-3 rounded-lg text-base font-medium text-red-600 hover:bg-red-50 transition-all duration-300">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
        @else
        <!-- Guest Mobile Links -->
        <div class="px-4 py-6 space-y-3">
            <a href="{{ route('login') }}" 
               class="flex items-center justify-center w-full px-6 py-3 text-base font-semibold rounded-lg border-2 border-[#00ADE5] text-[#016DAE] bg-white hover:bg-[#00ADE5] hover:text-white transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Login
            </a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" 
               class="flex items-center justify-center w-full px-6 py-3 text-base font-semibold rounded-lg bg-gradient-to-r from-[#00ADE5] to-[#016DAE] text-white hover:shadow-lg transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Register
            </a>
            @endif
        </div>
        @endauth
    </div>
</nav>