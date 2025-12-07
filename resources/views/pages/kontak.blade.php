<x-app-layout>
<div class="min-h-screen bg-[#E0F7FE] py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->

            <!-- Contact Information and Feedback Form -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <!-- Contact Information -->
            <div class="scroll-animate bg-gradient-to-br from-[#00ADE5] to-[#016DAE] rounded-2xl p-8 text-white shadow-xl relative overflow-hidden opacity-0 transform translate-y-8 transition-all duration-700 ease-out">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mr-4 transform transition-transform duration-300 hover:scale-110">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold">Kontak Informasi</h2>
                </div>
                <p class="text-blue-100 mb-8">Katakan sesuatu untuk memulai daralan langsungi</p>
                
                <div class="space-y-6">
                    <div class="flex items-center transform transition-all duration-300 hover:translate-x-2">
                        <svg class="w-5 h-5 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span>(0281) 642765</span>
                    </div>
                    
                    <div class="flex items-center transform transition-all duration-300 hover:translate-x-2">
                        <svg class="w-5 h-5 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>dinkominfo@banyumaskab.gold</span>
                    </div>
                    
                    <div class="flex items-start transform transition-all duration-300 hover:translate-x-2">
                        <svg class="w-5 h-5 mr-4 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Jl. Masjid No. 8, Sokanegara, Kec.<br>Purwokerto Timur, Kabupaten Banyumas,<br>Jawa Tengah 53115</span>
                    </div>
                </div>

                <!-- Lingkaran Dekoratif -->
            <!-- Lingkaran Dekoratif -->
            <div class="absolute bottom right-3 w-80 h-80 bg-[#51cef887] rounded-full"></div>
            <div class="absolute bottom-20 left-40 w-40 h-40 bg-[#51cef887] rounded-full"></div>
            </div>

                <!-- Feedback Form -->
                <div class="scroll-animate bg-white rounded-2xl p-8 shadow-xl opacity-0 transform translate-y-8 transition-all duration-700 ease-out">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Kirim Feedback</h2>
                    
                    @auth
                        @if(session('success'))
                            <div id="flash-message" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                                <p class="text-green-800">{{ session('success') }}</p>
                            </div>
                        @endif

                        @if(session('error'))
                            <div id="flash-message" class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                                <p class="text-red-800">{{ session('error') }}</p>
                            </div>
                        @endif
                        <form action="{{ route('kontak.feedback') }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="subjek" class="block text-sm font-medium text-gray-700 mb-2">Pilih Subjek</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3" required>
                                    <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer transform transition-all duration-300 hover:scale-105 hover:shadow-md">
                                        <input type="radio" name="subjek" value="masalah_teknis" {{ old('subjek') == 'masalah_teknis' ? 'checked' : '' }} 
                                               class="mr-3 text-[#00ADE5] focus:ring-[#00ADE5]">
                                        <div>
                                            <span class="text-sm font-medium">Masalah Teknis</span>
                                            <p class="text-xs text-gray-500">Kendala teknis sistem ITSA</p>
                                        </div>
                                    </label>
                                    <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer transform transition-all duration-300 hover:scale-105 hover:shadow-md">
                                        <input type="radio" name="subjek" value="keluhan_layanan" {{ old('subjek') == 'keluhan_layanan' ? 'checked' : '' }} 
                                               class="mr-3 text-[#00ADE5] focus:ring-[#00ADE5]">
                                        <div>
                                            <span class="text-sm font-medium">Keluhan Layanan</span>
                                            <p class="text-xs text-gray-500">Keluhan terkait layanan</p>
                                        </div>
                                    </label>
                                    <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer transform transition-all duration-300 hover:scale-105 hover:shadow-md">
                                        <input type="radio" name="subjek" value="saran_pengembangan" {{ old('subjek') == 'saran_pengembangan' ? 'checked' : '' }} 
                                               class="mr-3 text-[#00ADE5] focus:ring-[#00ADE5]">
                                        <div>
                                            <span class="text-sm font-medium">Saran Pengembangan</span>
                                            <p class="text-xs text-gray-500">Ide untuk perbaikan sistem</p>
                                        </div>
                                    </label>
                                    <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer transform transition-all duration-300 hover:scale-105 hover:shadow-md">
                                        <input type="radio" name="subjek" value="pertanyaan_informasi" {{ old('subjek') == 'pertanyaan_informasi' ? 'checked' : '' }} 
                                               class="mr-3 text-[#00ADE5] focus:ring-[#00ADE5]">
                                        <div>
                                            <span class="text-sm font-medium">Pertanyaan Informasi</span>
                                            <p class="text-xs text-gray-500">Pertanyaan umum ITSA</p>
                                        </div>
                                    </label>
                                </div>
                                @error('subjek')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="pesan" class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                                <textarea id="pesan" name="pesan" rows="5" 
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent @error('pesan') border-red-500 @enderror transform transition-all duration-300 hover:shadow-md" 
                                          placeholder="Tuliskan pesan Anda...">{{ old('pesan') }}</textarea>
                                @error('pesan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" 
                                        class="bg-gradient-to-r from-[#00ADE5] to-[#016DAE] text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                    Kirim Feedback
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 transform transition-all duration-300 hover:scale-110">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Login Diperlukan</h3>
                            <p class="text-gray-600 mb-6">Silakan login terlebih dahulu untuk mengirim feedback</p>
                            <a href="{{ route('login') }}" 
                               class="bg-gradient-to-r from-[#00ADE5] to-[#016DAE] text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                Login Sekarang
                            </a>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Location Section -->
            <div class="scroll-animate bg-white rounded-2xl shadow-xl overflow-hidden opacity-0 transform translate-y-8 transition-all duration-700 ease-out">
                <div class="p-8">
                    <p class="text-gray-600 mb-6">
                        Dinas Komunikasi dan Informatika Bidang Persandian dan Telekomunikasi Banyumas
                    </p>
                    <div class="flex items-center text-gray-700 mb-6 transform transition-all duration-300 hover:translate-x-2">
                        <svg class="w-5 h-5 mr-3 text-[#00ADE5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Jl. Masjid No. 8, Sokanegara, Kec. Purwokerto Timur, Kabupaten Banyumas, Jawa Tengah 53115</span>
                    </div>
                </div>
                
                <!-- Google Maps Embed -->
                <div class="w-full h-96 bg-gray-100 overflow-hidden">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.2134567890123!2d109.2123456789012!3d-7.4123456789012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655ea49a9f9999%3A0x1111111111111111!2sJl.%20Masjid%20No.8%2C%20Sokanegara%2C%20Kec.%20Purwokerto%20Tim.%2C%20Kabupaten%20Banyumas%2C%20Jawa%20Tengah%2053115!5e0!3m2!1sid!2sid!4v1234567890123!5m2!1sid!2sid" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            class="transform transition-all duration-300 hover:scale-105">
                    </iframe>
                </div>
                
                <!-- Direct Link to Google Maps -->
                <div class="p-6 bg-gray-50 border-t">
                    <a href="https://maps.app.goo.gl/UmoxzjGgTkPZbHVJ9" 
                       target="_blank" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#00ADE5] to-[#016DAE] text-white rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Buka di Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const flash = document.getElementById('flash-message');
        if (flash) {
            setTimeout(() => {
                flash.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                setTimeout(() => flash.remove(), 500); // Setelah animasi selesai, hapus elemen
            }, 5000); // 5000 ms = 5 detik
        }

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
        const animateElements = document.querySelectorAll('.scroll-animate');
        animateElements.forEach((el, index) => {
            // Delay untuk setiap card agar muncul berurutan
            el.style.transitionDelay = `${index * 0.2}s`;
            observer.observe(el);
        });

        // CSS untuk animasi tambahan
        const style = document.createElement('style');
        style.textContent = `
            .animate-in {
                opacity: 1 !important;
                transform: translateY(0) !important;
            }
            
            .scroll-animate {
                transition: opacity 0.7s ease-out, transform 0.7s ease-out;
            }
            
            /* Subtle pulse animation untuk icons */
            @keyframes gentle-pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.05); }
            }
            
            .scroll-animate.animate-in .w-12.h-12 {
                animation: gentle-pulse 2s ease-in-out infinite;
                animation-delay: 1s;
            }
            
            /* Staggered animation untuk form options */
            .scroll-animate.animate-in .grid label {
                opacity: 0;
                transform: translateX(-20px);
                animation: slideInLeft 0.6s ease-out forwards;
            }
            
            .scroll-animate.animate-in .grid label:nth-child(1) { animation-delay: 0.3s; }
            .scroll-animate.animate-in .grid label:nth-child(2) { animation-delay: 0.4s; }
            .scroll-animate.animate-in .grid label:nth-child(3) { animation-delay: 0.5s; }
            .scroll-animate.animate-in .grid label:nth-child(4) { animation-delay: 0.6s; }
            
            /* Staggered animation untuk contact info */
            .scroll-animate.animate-in .space-y-6 > div {
                opacity: 0;
                transform: translateX(-20px);
                animation: slideInLeft 0.6s ease-out forwards;
            }
            
            .scroll-animate.animate-in .space-y-6 > div:nth-child(1) { animation-delay: 0.3s; }
            .scroll-animate.animate-in .space-y-6 > div:nth-child(2) { animation-delay: 0.4s; }
            .scroll-animate.animate-in .space-y-6 > div:nth-child(3) { animation-delay: 0.5s; }
            
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
            
            /* Floating animation untuk decorative circles */
            .scroll-animate.animate-in .absolute.rounded-full {
                animation: float 3s ease-in-out infinite;
            }
            
            .scroll-animate.animate-in .absolute.rounded-full:nth-of-type(2) {
                animation-delay: 1.5s;
            }
            
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
        `;
        document.head.appendChild(style);
    });
</script>

</x-app-layout>