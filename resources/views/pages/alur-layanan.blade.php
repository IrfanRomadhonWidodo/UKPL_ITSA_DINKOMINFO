<x-app-layout>
<div class="bg-[#E0F7FE] min-h-screen py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-20">
            <h1 class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#016DAE] to-[#00ADE5] mb-4 pb-2 leading-[1.25]">
                Alur Layanan ITSA
            </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Panduan lengkap proses layanan IT Security Assessment yang profesional dan terstruktur
                </p>
                <div class="w-24 h-1 bg-gradient-to-r from-[#016DAE] to-[#00ADE5] mx-auto mt-6 rounded-full"></div>
            </div>

            <!-- Timeline Container -->
            <div class="relative max-w-5xl mx-auto">
                <!-- Main Timeline Line -->
                <div class="absolute left-1/2 transform -translate-x-1/2 w-1 bg-gradient-to-b from-[#016DAE] via-[#00ADE5] to-[#016DAE] rounded-full"
                    style="top: calc(4rem + 50px); bottom: calc(4rem + 60px);">
                </div>
                @php
                    $steps = [
                        [
                            'title' => 'Registrasi & Login',
                            'desc' => 'Pengguna mendaftar akun di sistem ITSA dengan mengisi data lengkap. Setelah berhasil login, akun akan masuk ke dalam antrian untuk diperiksa oleh admin. Status awal akun adalah "Diproses" hingga mendapat persetujuan.',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>',
                            'color' => 'from-blue-500 to-cyan-500'
                        ],
                        [
                            'title' => 'Verifikasi Akun oleh Admin',
                            'desc' => 'Admin melakukan tinjauan mendalam terhadap akun yang telah didaftarkan. Jika data lengkap dan memenuhi syarat, akun akan disetujui dan pengguna mendapat notifikasi email. Jika ada kekurangan, pemberitahuan penolakan beserta alasan akan dikirim melalui email.',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                            'color' => 'from-green-500 to-emerald-500'
                        ],
                        [
                            'title' => 'Pengisian Formulir Permintaan',
                            'desc' => 'Pengguna yang telah disetujui dapat mengakses dashboard lengkap dan mengisi formulir permintaan pemeriksaan situs web. Formulir mencakup detail teknis, keamanan, dan spesifikasi yang dibutuhkan untuk proses assessment.',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>',
                            'color' => 'from-purple-500 to-indigo-500'
                        ],
                        [
                            'title' => 'Pemeriksaan oleh Admin',
                            'desc' => 'Tim admin melakukan proses IT Security Assessment (ITSA) yang komprehensif. Pemeriksaan mencakup audit keamanan, penetrasi testing, dan evaluasi sistem. Status formulir akan berubah menjadi "Selesai" atau "Revisi" jika ada aspek yang perlu diperbaiki.',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>',
                            'color' => 'from-orange-500 to-red-500'
                        ],
                        [
                            'title' => 'Revisi (Jika Diperlukan)',
                            'desc' => 'Apabila hasil pemeriksaan memerlukan perbaikan atau tambahan informasi, pengguna dapat mengakses halaman Riwayat untuk mengedit ulang formulir. Setelah revisi selesai, formulir dapat dikirim ulang untuk pemeriksaan lanjutan.',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>',
                            'color' => 'from-yellow-500 to-orange-500'
                        ],
                        [
                            'title' => 'Hasil ITSA (PDF)',
                            'desc' => 'Setelah pemeriksaan selesai, admin akan mengunggah hasil lengkap dalam format PDF yang mencakup temuan, rekomendasi, dan sertifikat keamanan. File dapat diakses melalui halaman Riwayat atau melalui notifikasi email.',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>',
                            'color' => 'from-teal-500 to-cyan-500'
                        ],
                        [
                            'title' => 'Umpan Balik & Balasan',
                            'desc' => 'Pengguna dapat memberikan feedback mengenai layanan yang diterima. Admin akan merespons setiap masukan dan balasan akan ditampilkan di halaman Notifikasi untuk memastikan komunikasi yang efektif dan peningkatan layanan berkelanjutan.',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>',
                            'color' => 'from-pink-500 to-rose-500'
                        ],
                    ];
                @endphp

                @foreach ($steps as $i => $step)
                    <div class="timeline-item opacity-0 transform translate-y-8 transition-all duration-700 ease-out mb-16" data-aos="fade-up">
                        <div class="flex items-center {{ $i % 2 === 0 ? 'flex-row' : 'flex-row-reverse' }}">
                            <!-- Content Card -->
                            <div class="w-5/12 {{ $i % 2 === 0 ? 'pr-8' : 'pl-8' }}">
                                <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 overflow-hidden">
                                    <div class="bg-gradient-to-r {{ $step['color'] }} p-6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        {!! $step['icon'] !!}
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="text-white/80 text-sm font-medium">Step {{ $i + 1 }}</div>
                                                    <h3 class="text-2xl font-bold text-white">{{ $step['title'] }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <p class="text-gray-700 leading-relaxed text-justify">
                                            {{ $step['desc'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Timeline Node -->
                            <div class="w-2/12 flex justify-center">
                                <div class="relative">
                                    <div class="w-16 h-16 bg-gradient-to-r {{ $step['color'] }} rounded-full flex items-center justify-center shadow-lg transform hover:scale-110 transition-transform duration-300">
                                        <span class="text-white font-bold text-lg">{{ $i + 1 }}</span>
                                    </div>
                                    <div class="absolute -inset-2 bg-gradient-to-r {{ $step['color'] }} rounded-full opacity-20 animate-pulse"></div>
                                </div>
                            </div>

                            <!-- Empty Space -->
                            <div class="w-5/12"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Call to Action -->
            <div class="text-center mt-24">
                <div class="bg-white rounded-3xl shadow-2xl p-12 max-w-2xl mx-auto">
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">Siap Memulai Assessment?</h2>
                        <p class="text-gray-600 text-lg">
                            Tingkatkan keamanan sistem Anda dengan layanan ITSA profesional kami
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center justify-center bg-gradient-to-r from-[#016DAE] to-[#00ADE5] text-white font-semibold px-8 py-4 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 transform">
                                <div class="flex items-center justify-center w-4 h-4 mr-2">
                                    <svg class="w-5 h-5 opacity-70 group-hover:opacity-100 transition" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9.75L12 3l9 6.75M4.5 10.5V20a1.5 1.5 0 001.5 1.5H9V15a1.5 1.5 0 011.5-1.5h3A1.5 1.5 0 0115 15v6.5h3a1.5 1.5 0 001.5-1.5v-9.5" />
                                    </svg>
                                </div>
                            Kembali ke Dashboard
                        </a>
                        <a href="{{ route('faq') }}"
                           class="inline-flex items-center justify-center border-2 border-[#016DAE] text-[#016DAE] font-semibold px-8 py-4 rounded-full hover:bg-[#016DAE] hover:text-white transition-all duration-300 hover:scale-105 transform">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Bantuan & FAQ
                        </a>
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
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove('opacity-0', 'translate-y-8');
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                }
            });
        }, observerOptions);

        // Observe semua timeline items
        document.addEventListener('DOMContentLoaded', () => {
            const timelineItems = document.querySelectorAll('.timeline-item');
            timelineItems.forEach((item, index) => {
                // Delay untuk efek spawn berurutan
                setTimeout(() => {
                    observer.observe(item);
                }, index * 100);
            });
        });

        // Smooth scrolling enhancement
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</x-app-layout>