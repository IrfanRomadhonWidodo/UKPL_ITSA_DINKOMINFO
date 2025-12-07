<x-app-layout>
    <div class="bg-gradient-to-br from-slate-50 via-blue-50 to-cyan-50 min-h-screen relative overflow-hidden">
        <div class="bg-[#E0F7FE] min-h-screen py-0 px-4 sm:px-6 lg:px-8">

        <!-- Enhanced Background Pattern -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_50%,rgba(59,130,246,0.08)_0%,transparent_50%)] opacity-60"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(14,165,233,0.08)_0%,transparent_50%)] opacity-60"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_40%_80%,rgba(59,130,246,0.05)_0%,transparent_50%)] opacity-60"></div>
        
        <!-- Bulatan Besar (tanpa blur, terlihat penuh) -->
        <div class="absolute -top-20 -left-20 w-[26rem] h-[26rem] rounded-full 
                    bg-gradient-to-br from-blue-400/70 to-cyan-300/10 
                    border border-white/10 
                    shadow-[0_0_60px_rgba(56,189,248,0.15)]">
        </div>

        
        <!-- Additional Decorative Elements -->
        <div class="absolute top-1/4 right-1/4 w-2 h-2 rounded-full bg-blue-400/40 animate-ping"></div>
        <div class="absolute top-1/3 right-1/3 w-1 h-1 rounded-full bg-cyan-400/60 animate-pulse delay-500"></div>
        <div class="absolute top-2/3 left-1/4 w-3 h-3 rounded-full bg-blue-300/30 animate-bounce delay-1000"></div>
        
        <!-- Geometric Accent Lines -->
        <div class="absolute top-20 right-20 w-32 h-px bg-gradient-to-r from-transparent via-blue-400/30 to-transparent transform rotate-45"></div>
        <div class="absolute bottom-32 left-20 w-24 h-px bg-gradient-to-r from-transparent via-cyan-400/30 to-transparent transform -rotate-45"></div>
        
        <!-- Floating Elements (Enhanced) -->
        <div class="absolute top-20 left-10 w-32 h-32 bg-gradient-to-br from-blue-400/15 to-cyan-400/15 rounded-full blur-2xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-48 h-48 bg-gradient-to-br from-cyan-400/15 to-blue-400/15 rounded-full blur-2xl animate-pulse delay-1000"></div>
        
        <!-- Subtle Grid Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgba(59,130,246,0.3) 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>
        
        <div class="relative z-10 py-12 sm:py-16 lg:py-20 px-4 sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="max-w-7xl mx-auto mb-20 sm:mb-24 lg:mb-28">
                <div class="opacity-0 translate-y-8 transition-all duration-1000 ease-out" data-animate="hero-title">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                        <!-- Left Content -->
                        <div class="text-left space-y-6">
                            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black bg-gradient-to-r from-[#016DAE] via-[#00ADE5] to-[#016DAE] bg-clip-text text-transparent leading-tight">
                                SELAMAT DATANG
                            </h1>
                            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-gray-900">
                                DI LAYANAN ITSA
                            </h2>
                            <p class="text-gray-600 text-lg sm:text-xl leading-relaxed font-medium max-w-xl">
                                Platform layanan IT Security Assessment yang profesional, terstruktur, dan terpercaya. Kami membantu mengamankan sistem dan aplikasi Anda dari berbagai ancaman keamanan siber.
                            </p>
                            <div class="pt-4">
                                <a href="{{ route('formulir.index') }}" class="inline-block bg-gradient-to-r from-[#016DAE] to-[#00ADE5] text-white font-bold px-10 sm:px-12 py-4 sm:py-5 rounded-full shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-300 text-lg sm:text-xl relative overflow-hidden group">
                                    <span class="relative z-10 flex items-center">
                                        Mulai Pengajuan
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6L8 4l8 8-8 8 2-2 6-6-6-6z"></path>
                                        </svg>
                                    </span>
                                    <div class="absolute inset-0 bg-gradient-to-r from-[#00ADE5] to-[#016DAE] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Right Image Carousel -->
                        <div class="flex justify-center lg:justify-end">
                            <div class="w-full max-w-md lg:max-w-lg">
                                <div class="relative rounded-3xl shadow-2xl overflow-hidden hover:shadow-3xl transition-all duration-500 aspect-square bg-white backdrop-blur-sm border border-white/20">
                                    <!-- Image Container -->
                                    <div class="relative w-full h-full overflow-hidden">
                                        <!-- Slide 1 -->
                                        <div class="absolute inset-0 w-full h-full transition-transform duration-700 ease-in-out transform translate-x-0" id="slide-1">
                                            <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
                                                 alt="Cybersecurity Team" 
                                                 class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                                            <div class="absolute bottom-6 left-6 text-white">
                                                <h3 class="text-xl font-bold mb-2">Security Assessment</h3>
                                                <p class="text-sm opacity-90">Evaluasi keamanan komprehensif</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Slide 2 -->
                                        <div class="absolute inset-0 w-full h-full transition-transform duration-700 ease-in-out transform translate-x-full" id="slide-2">
                                            <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
                                                 alt="Data Protection" 
                                                 class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                                            <div class="absolute bottom-6 left-6 text-white">
                                                <h3 class="text-xl font-bold mb-2">Data Protection</h3>
                                                <p class="text-sm opacity-90">Perlindungan data tingkat enterprise</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Slide 3 -->
                                        <div class="absolute inset-0 w-full h-full transition-transform duration-700 ease-in-out transform translate-x-full" id="slide-3">
                                            <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
                                                 alt="Network Security" 
                                                 class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                                            <div class="absolute bottom-6 left-6 text-white">
                                                <h3 class="text-xl font-bold mb-2">Network Security</h3>
                                                <p class="text-sm opacity-90">Keamanan jaringan terintegrasi</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Navigation Dots -->
                                    <div class="absolute bottom-4 right-4 flex space-x-2">
                                        <button class="w-3 h-3 rounded-full bg-white/60 transition-all duration-300 hover:bg-white/80 focus:outline-none focus:ring-2 focus:ring-white/50 carousel-dot active" data-slide="1"></button>
                                        <button class="w-3 h-3 rounded-full bg-white/40 transition-all duration-300 hover:bg-white/80 focus:outline-none focus:ring-2 focus:ring-white/50 carousel-dot" data-slide="2"></button>
                                        <button class="w-3 h-3 rounded-full bg-white/40 transition-all duration-300 hover:bg-white/80 focus:outline-none focus:ring-2 focus:ring-white/50 carousel-dot" data-slide="3"></button>
                                    </div>
                                    
                                    <!-- Navigation Arrows -->
                                    <button class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 text-white hover:bg-white/30 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-white/50 carousel-prev" aria-label="Previous slide">
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </button>
                                    <button class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 text-white hover:bg-white/30 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-white/50 carousel-next" aria-label="Next slide">
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


{{-- Data Section --}}
<div class="mb-8">
    <h2 class="text-4xl font-bold text-[#016DAE] mb-8 text-center tracking-tight">Ringkasan Data</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: Total Formulir -->
        <div class="relative group overflow-hidden bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl hover:shadow-2xl opacity-0 transform translate-y-8 transition-all duration-700 ease-out border border-gray-200/50" 
             data-animate 
             data-delay="100">
            <div class="absolute inset-0 bg-gradient-to-br from-[#016DAE]/5 to-[#00ADE5]/5"></div>
            <div class="relative p-8">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-[#016DAE]/10 to-[#00ADE5]/10 border border-[#016DAE]/20">
                        <svg class="w-6 h-6 text-[#016DAE]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="flex items-center space-x-1">
                        <div class="w-2 h-2 rounded-full animate-pulse bg-[#016DAE]"></div>
                        <div class="w-1 h-1 rounded-full animate-pulse bg-[#016DAE]" style="animation-delay: 0.2s;"></div>
                        <div class="w-1 h-1 rounded-full animate-pulse bg-[#016DAE]" style="animation-delay: 0.4s;"></div>
                    </div>
                </div>
                <p class="text-gray-600 text-sm font-medium mb-3 uppercase tracking-wide">Total Formulir yang Diajukan</p>
                <p class="text-4xl font-bold counter tracking-tight text-[#016DAE]" data-target="{{ $totalFormulir }}">0</p>
                <div class="mt-4 flex items-center text-xs text-gray-500">
                    <div class="flex items-center">
                        <div class="w-2 h-2 rounded-full mr-2 bg-[#016DAE]"></div>
                        <span>Semua formulir</span>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-[#016DAE] to-[#00ADE5]"></div>
        </div>

        <!-- Card 2: Aplikasi Selesai -->
        <div class="relative group overflow-hidden bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl hover:shadow-2xl opacity-0 transform translate-y-8 transition-all duration-700 ease-out border border-gray-200/50" 
             data-animate 
             data-delay="200">
            <div class="absolute inset-0 bg-gradient-to-br from-[#00ADE5]/5 to-[#016DAE]/5"></div>
            <div class="relative p-8">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-[#00ADE5]/10 to-[#016DAE]/10 border border-[#00ADE5]/20">
                        <svg class="w-6 h-6 text-[#00ADE5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex items-center space-x-1">
                        <div class="w-2 h-2 rounded-full animate-pulse bg-[#00ADE5]"></div>
                        <div class="w-1 h-1 rounded-full animate-pulse bg-[#00ADE5]" style="animation-delay: 0.2s;"></div>
                        <div class="w-1 h-1 rounded-full animate-pulse bg-[#00ADE5]" style="animation-delay: 0.4s;"></div>
                    </div>
                </div>
                <p class="text-gray-600 text-sm font-medium mb-3 uppercase tracking-wide">Aplikasi Selesai Di ITSA</p>
                <p class="text-4xl font-bold counter tracking-tight text-[#00ADE5]" data-target="{{ $formulirSelesai }}">0</p>
                <div class="mt-4 flex items-center text-xs text-gray-500">
                    <div class="flex items-center">
                        <div class="w-2 h-2 rounded-full mr-2 bg-[#00ADE5]"></div>
                        <span>Status selesai</span>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-[#00ADE5] to-[#016DAE]"></div>
        </div>

        <!-- Card 3: Total Feedback -->
        <div class="relative group overflow-hidden bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl hover:shadow-2xl opacity-0 transform translate-y-8 transition-all duration-700 ease-out border border-gray-200/50" 
             data-animate 
             data-delay="300">
            <div class="absolute inset-0 bg-gradient-to-br from-[#016DAE]/5 to-[#00ADE5]/5"></div>
            <div class="relative p-8">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-[#016DAE]/10 to-[#00ADE5]/10 border border-[#016DAE]/20">
                        <svg class="w-6 h-6 text-[#016DAE]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <div class="flex items-center space-x-1">
                        <div class="w-2 h-2 rounded-full animate-pulse bg-[#016DAE]"></div>
                        <div class="w-1 h-1 rounded-full animate-pulse bg-[#016DAE]" style="animation-delay: 0.2s;"></div>
                        <div class="w-1 h-1 rounded-full animate-pulse bg-[#016DAE]" style="animation-delay: 0.4s;"></div>
                    </div>
                </div>
                <p class="text-gray-600 text-sm font-medium mb-3 uppercase tracking-wide">Total Feedback Masuk</p>
                <p class="text-4xl font-bold counter tracking-tight text-[#016DAE]" data-target="{{ $totalFeedback }}">0</p>
                <div class="mt-4 flex items-center text-xs text-gray-500">
                    <div class="flex items-center">
                        <div class="w-2 h-2 rounded-full mr-2 bg-[#016DAE]"></div>
                        <span>Semua feedback</span>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-[#016DAE] to-[#00ADE5]"></div>
        </div>
    </div>
</div>

{{-- Daftar Hasil ITSA --}}
<div class="mt-12" data-animate data-delay="100">
    <!-- Section Header -->
    <div id="hasil-itsa" class="mb-8 opacity-0 translate-y-8 transition-all duration-700 ease-out" data-animate data-delay="200">
        <h2 class="text-3xl font-bold bg-gradient-to-r from-[#00ADE5] to-[#016DAE] bg-clip-text text-transparent mb-3">
            Daftar Hasil ITSA
        </h2>
        <div class="w-24 h-1 bg-gradient-to-r from-[#00ADE5] to-[#016DAE] rounded-full"></div>
    </div>

    <!-- Results Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($hasilList as $hasil)
            <div class="bg-white border border-gray-100 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 ease-out overflow-hidden opacity-0 translate-y-8" data-animate data-delay="300">
                <div class="relative overflow-hidden">
                    @if($hasil->image)
                        <img src="{{ asset('storage/' . $hasil->image) }}" alt="Gambar Hasil ITSA" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-[#00ADE5]/10 to-[#016DAE]/10 flex items-center justify-center">
                            <div class="text-[#00ADE5] opacity-50">
                                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-[#00ADE5] transition-colors duration-300">
                        {{ $hasil->formulir->nama_aplikasi ?? 'Tanpa Nama' }}
                    </h3>
                <div x-data="{ expanded: false }">
                    <p 
                        class="text-gray-600 mb-1 transition-all duration-300 ease-in-out"
                        :class="expanded ? 'line-clamp-none' : 'line-clamp-3'"
                    >
                        {{ $hasil->deskripsi }}
                    </p>
                    <button 
                        @click="expanded = !expanded"
                        class="text-sm text-[#016DAE] hover:text-[#00ADE5] focus:outline-none"
                    >
                        <span x-show="!expanded">Lihat Selengkapnya</span>
                        <span x-show="expanded">Tutup</span>
                    </button>
                </div>
                <div x-data="{ show: false }">
                    <button @click="show = !show"></button>
                    <p x-show="show"></p>
                </div>
                @if($hasil->tautan)
                    <div class="flex items-center justify-between">
                        <a href="{{ $hasil->tautan }}" 
                        class="inline-flex items-center text-[#016DAE] hover:text-[#00ADE5] font-medium text-sm transition-colors duration-300" 
                        target="_blank" 
                        rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M2 12h20" />
                                <path d="M12 2a15 15 0 0 1 0 20" />
                                <path d="M12 2a15 15 0 0 0 0 20" />
                            </svg>
                            Lihat Website
                        </a>
                    </div>
                @endif
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="col-span-full opacity-0 translate-y-8 transition-all duration-700 ease-out" data-animate data-delay="300" id="empty-state">
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-[#00ADE5]/10 to-[#016DAE]/10 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-[#00ADE5] opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Hasil ITSA</h3>
                    <p class="text-gray-500 max-w-md mx-auto">
                        Hasil ITSA akan ditampilkan di sini setelah tersedia. Silakan periksa kembali nanti.
                    </p>
                </div>
            </div>
        @endforelse
    </div>
    <div class="mt-8 flex justify-center opacity-0 translate-y-8 transition-all duration-700 ease-out" data-animate data-delay="400">
    {{ $hasilList->withQueryString()->fragment('hasil-itsa')->links() }}
</div>
</div>



        </div>
    </div>

    <script>
// Animation Observer - hanya untuk animasi masuk
function createAnimationObserver() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const delay = element.dataset.delay || 0;
                
                setTimeout(() => {
                    requestAnimationFrame(() => {
                        element.classList.remove('opacity-0', 'translate-y-8');
                        element.classList.add('opacity-100', 'translate-y-0');
                        
                        // Counter animation
                        const counter = element.querySelector('.counter');
                        if (counter) {
                            animateCounter(counter);
                        }
                    });
                }, delay);
                
                observer.unobserve(element);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '100px'
    });

    return observer;
}

// Counter Animation
function animateCounter(element) {
    const target = parseInt(element.dataset.target);
    const duration = 1500;
    const stepTime = 50;
    const steps = duration / stepTime;
    
    let current = 0;
    let step = 0;
    
    const timer = setInterval(() => {
        step++;
        const progress = step / steps;
        const easeOutQuart = 1 - Math.pow(1 - progress, 3);
        const displayValue = Math.floor(target * easeOutQuart);
        
        element.textContent = displayValue.toLocaleString();
        
        if (step >= steps) {
            clearInterval(timer);
            element.textContent = target.toLocaleString();
        }
    }, stepTime);
}

// Carousel functionality (keeping original)
class ImageCarousel {
    constructor() {
        this.currentSlide = 1;
        this.totalSlides = 3;
        this.autoPlayInterval = null;
        this.isTransitioning = false;
        
        this.init();
    }
    
    init() {
        this.setupEventListeners();
        this.startAutoPlay();
    }
    
    setupEventListeners() {
        // Dot navigation
        document.querySelectorAll('.carousel-dot').forEach(dot => {
            dot.addEventListener('click', (e) => {
                const slideNum = parseInt(e.target.dataset.slide);
                this.goToSlide(slideNum);
            });
        });
        
        // Arrow navigation
        const prevBtn = document.querySelector('.carousel-prev');
        const nextBtn = document.querySelector('.carousel-next');
        
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                this.previousSlide();
            });
        }
        
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                this.nextSlide();
            });
        }
        
        // Pause auto-play on hover
        const carousel = document.querySelector('.relative.rounded-3xl');
        if (carousel) {
            carousel.addEventListener('mouseenter', () => {
                this.pauseAutoPlay();
            });
            
            carousel.addEventListener('mouseleave', () => {
                this.startAutoPlay();
            });
        }
    }
    
    goToSlide(slideNum) {
        if (this.isTransitioning || slideNum === this.currentSlide) return;

        this.isTransitioning = true;

        const currentSlideEl = document.getElementById(`slide-${this.currentSlide}`);
        const targetSlideEl = document.getElementById(`slide-${slideNum}`);

        if (currentSlideEl && targetSlideEl) {
            // Reset posisi target slide di kanan
            targetSlideEl.style.transform = 'translateX(100%)';
            targetSlideEl.style.transition = 'none';
            
            // Force reflow
            targetSlideEl.offsetHeight;

            // Animate both slides (slide left)
            currentSlideEl.style.transition = 'transform 0.7s ease-in-out';
            targetSlideEl.style.transition = 'transform 0.7s ease-in-out';

            currentSlideEl.style.transform = 'translateX(-100%)';
            targetSlideEl.style.transform = 'translateX(0)';

            // Update dots
            this.updateDots(slideNum);
            this.currentSlide = slideNum;

            setTimeout(() => {
                this.isTransitioning = false;
            }, 700);
        }
    }
    
    nextSlide() {
        const nextSlide = this.currentSlide === this.totalSlides ? 1 : this.currentSlide + 1;
        this.goToSlide(nextSlide);
    }
    
    previousSlide() {
        const prevSlide = this.currentSlide === 1 ? this.totalSlides : this.currentSlide - 1;
        this.goToSlide(prevSlide);
    }
    
    updateDots(activeSlide) {
        document.querySelectorAll('.carousel-dot').forEach((dot, index) => {
            if (index + 1 === activeSlide) {
                dot.classList.add('active');
                dot.classList.remove('bg-white/40');
                dot.classList.add('bg-white/60');
            } else {
                dot.classList.remove('active');
                dot.classList.remove('bg-white/60');
                dot.classList.add('bg-white/40');
            }
        });
    }
    
    startAutoPlay() {
        this.autoPlayInterval = setInterval(() => {
            this.nextSlide();
        }, 4000);
    }
    
    pauseAutoPlay() {
        if (this.autoPlayInterval) {
            clearInterval(this.autoPlayInterval);
            this.autoPlayInterval = null;
        }
    }
}

// Initialize everything when DOM is ready
document.addEventListener('DOMContentLoaded', function () {
    // Initialize animation observer
    const observer = createAnimationObserver();
    const animatedElements = document.querySelectorAll('[data-animate]');
    animatedElements.forEach(element => {
        observer.observe(element);
    });
    
    // Initialize carousel
    new ImageCarousel();
});


    </script>
</x-app-layout>