<x-app-layout>
<div class="py-12 bg-[#E0F7FE]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-[#00ADE5] to-[#016DAE] overflow-hidden shadow-xl sm:rounded-lg mb-8">
                <div class="p-8 sm:p-12">
                    <div class="flex flex-col lg:flex-row items-center">
                        <div class="flex-1 text-white">
                            <h1 class="text-4xl sm:text-5xl font-bold mb-4">
                                Profil ITSA
                            </h1>
                            <p class="text-xl sm:text-2xl opacity-90 mb-6">
                                Integrated Technology Service Application
                            </p>
                            <p class="text-lg opacity-80 leading-relaxed">
                                Platform digital terpadu untuk layanan teknologi informasi di Kabupaten Banyumas
                            </p>
                        </div>
                        <div class="flex-shrink-0 mt-8 lg:mt-0 lg:ml-12">
                            <img src="/image/logo_banyumas.png" alt="Logo Banyumas" class="h-32 sm:h-40 w-auto drop-shadow-lg">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tentang ITSA Section -->
            <div class="scroll-animate bg-white overflow-hidden shadow-xl sm:rounded-lg mb-8 opacity-0 transform translate-y-8 transition-all duration-700 ease-out">
                <div class="p-8 sm:p-12">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-gradient-to-r from-[#00ADE5] to-[#016DAE] rounded-full flex items-center justify-center mr-4 transform transition-transform duration-300 hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800">{{ $data['tentang']['title'] }}</h2>
                    </div>
                    
                    <div class="grid md:grid-cols-1 gap-8">
                        <div class="space-y-6">
                            <div class="bg-gray-50 rounded-lg p-6 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                                <h3 class="text-xl font-semibold text-[#016DAE] mb-4">Penjelasan Umum</h3>
                                <p class="text-gray-700 leading-relaxed">
                                    {{ $data['tentang']['content'] }}
                                </p>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-6 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                                <h3 class="text-xl font-semibold text-[#016DAE] mb-4">Tujuan Pembentukan</h3>
                                <p class="text-gray-700 leading-relaxed">
                                    {{ $data['tentang']['penjelasan'] }}
                                </p>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-6 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                                <h3 class="text-xl font-semibold text-[#016DAE] mb-4">Latar Belakang</h3>
                                <p class="text-gray-700 leading-relaxed">
                                    {{ $data['tentang']['latar_belakang'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visi Section -->
            <div class="scroll-animate bg-white overflow-hidden shadow-xl sm:rounded-lg mb-8 opacity-0 transform translate-y-8 transition-all duration-700 ease-out">
                <div class="p-8 sm:p-12">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-gradient-to-r from-[#00ADE5] to-[#016DAE] rounded-full flex items-center justify-center mr-4 transform transition-transform duration-300 hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800">{{ $data['visi']['title'] }}</h2>
                    </div>
                    
                    <div class="bg-gradient-to-r from-[#00ADE5]/10 to-[#016DAE]/10 rounded-lg p-8 transform transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <p class="text-lg text-gray-700 leading-relaxed font-medium">
                            {{ $data['visi']['content'] }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Misi Section -->
            <div class="scroll-animate bg-white overflow-hidden shadow-xl sm:rounded-lg mb-8 opacity-0 transform translate-y-8 transition-all duration-700 ease-out">
                <div class="p-8 sm:p-12">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-gradient-to-r from-[#00ADE5] to-[#016DAE] rounded-full flex items-center justify-center mr-4 transform transition-transform duration-300 hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800">{{ $data['misi']['title'] }}</h2>
                    </div>
                    
                    <div class="grid md:grid-cols-1 gap-4">
                        @foreach($data['misi']['items'] as $index => $item)
                            <div class="flex items-start space-x-4 bg-gray-50 rounded-lg p-6 hover:bg-gray-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                                <div class="w-8 h-8 bg-gradient-to-r from-[#00ADE5] to-[#016DAE] rounded-full flex items-center justify-center flex-shrink-0 mt-1 transform transition-transform duration-300 hover:scale-110">
                                    <span class="text-white font-bold text-sm">{{ $index + 1 }}</span>
                                </div>
                                <p class="text-gray-700 leading-relaxed">{{ $item }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Tujuan Layanan Section -->
            <div class="scroll-animate bg-white overflow-hidden shadow-xl sm:rounded-lg mb-8 opacity-0 transform translate-y-8 transition-all duration-700 ease-out">
                <div class="p-8 sm:p-12">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-gradient-to-r from-[#00ADE5] to-[#016DAE] rounded-full flex items-center justify-center mr-4 transform transition-transform duration-300 hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800">{{ $data['tujuan']['title'] }}</h2>
                    </div>
                    
                    <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($data['tujuan']['items'] as $index => $item)
                            <div class="bg-gradient-to-br from-[#00ADE5]/5 to-[#016DAE]/5 rounded-lg p-6 border-l-4 border-[#00ADE5] hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                <div class="flex items-start space-x-4">
                                    <div class="w-8 h-8 bg-gradient-to-r from-[#00ADE5] to-[#016DAE] rounded-full flex items-center justify-center flex-shrink-0 mt-1 transform transition-transform duration-300 hover:scale-110">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-700 leading-relaxed">{{ $item }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Intersection Observer untuk animasi scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    entry.target.classList.remove('opacity-0', 'translate-y-8');
                }
            });
        }, observerOptions);

        // Observe semua elemen dengan class scroll-animate
        document.addEventListener('DOMContentLoaded', () => {
            const animateElements = document.querySelectorAll('.scroll-animate');
            animateElements.forEach(el => observer.observe(el));
        });

        // CSS untuk animasi
        const style = document.createElement('style');
        style.textContent = `
            .animate-in {
                opacity: 1 !important;
                transform: translateY(0) !important;
            }
            
            .scroll-animate {
                transition: opacity 0.7s ease-out, transform 0.7s ease-out;
            }
            
            /* Subtle pulse animation for icons */
            @keyframes gentle-pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.05); }
            }
            
            .scroll-animate.animate-in .w-12.h-12 {
                animation: gentle-pulse 2s ease-in-out infinite;
                animation-delay: 0.5s;
            }
            
            /* Staggered animation for misi and tujuan items */
            .scroll-animate.animate-in .grid > div {
                opacity: 0;
                transform: translateX(-20px);
                animation: slideInLeft 0.6s ease-out forwards;
            }
            
            .scroll-animate.animate-in .grid > div:nth-child(1) { animation-delay: 0.1s; }
            .scroll-animate.animate-in .grid > div:nth-child(2) { animation-delay: 0.2s; }
            .scroll-animate.animate-in .grid > div:nth-child(3) { animation-delay: 0.3s; }
            .scroll-animate.animate-in .grid > div:nth-child(4) { animation-delay: 0.4s; }
            .scroll-animate.animate-in .grid > div:nth-child(5) { animation-delay: 0.5s; }
            .scroll-animate.animate-in .grid > div:nth-child(6) { animation-delay: 0.6s; }
            
            @keyframes slideInLeft {
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
            
            /* Enhanced hover effects */
            .hover\\:shadow-lg:hover {
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
            
            .hover\\:shadow-md:hover {
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }
        `;
        document.head.appendChild(style);
    </script>
</x-app-layout>