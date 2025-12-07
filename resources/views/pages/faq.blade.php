<x-app-layout>
<div class="min-h-screen relative bg-[#E0F7FE]">
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900/3 to-sky-500/3 z-0"></div>
    
    <!-- Decorative Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-20 left-20 w-24 h-24 rounded-full bg-gradient-to-br from-blue-100 to-blue-200 opacity-30 animate-pulse"></div>
        <div class="absolute top-1/3 right-32 w-16 h-16 rounded-full bg-gradient-to-br from-blue-200 to-blue-300 opacity-25 animate-pulse" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-32 left-1/4 w-20 h-20 rounded-full bg-gradient-to-br from-blue-50 to-blue-100 opacity-40 animate-pulse" style="animation-delay: 4s;"></div>
        <div class="absolute top-1/2 left-1/2 w-12 h-12 rounded-full bg-gradient-to-br from-blue-300 to-blue-400 opacity-20 animate-pulse" style="animation-delay: 6s;"></div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12 relative z-10">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-20">
                <h1 class="text-6xl font-bold bg-gradient-to-r from-[#016DAE] to-[#00ADE5] bg-clip-text text-transparent mb-6 tracking-tight">FAQ</h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Temukan jawaban untuk pertanyaan yang sering diajukan seputar ITSA
                </p>
            </div>
            
            <!-- Popular Questions -->
            <div class="mb-20">
                <div class="flex items-center mb-10">
                    <div class="w-1 h-12 bg-gradient-to-b from-[#016DAE] to-[#00ADE5] rounded-full mr-4"></div>
                    <h2 class="text-3xl font-bold text-[#016DAE]">Pertanyaan Populer</h2>
                </div>
                
                <div class="space-y-6">
                    <!-- Question 1 -->
                    <div class="bg-white/95 backdrop-blur-sm border border-[#016DAE]/10 rounded-2xl overflow-hidden hover:shadow-lg hover:shadow-[#016DAE]/10 transition-all duration-300 hover:-translate-y-1">
                        <button class="w-full px-8 py-8 text-left hover:bg-blue-50/50 transition-all duration-300 flex items-center justify-between group" onclick="toggleAccordion('q1')">
                            <span class="font-semibold text-xl text-[#016DAE]">Apa itu ITSA?</span>
                            <svg class="w-6 h-6 transform transition-transform duration-300 text-[#00ADE5]" id="q1-icon" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7 10l5 5 5-5z"/>
                            </svg>
                        </button>
                        <div id="q1-content" class="overflow-hidden transition-all duration-500 ease-in-out max-h-0">
                            <div class="px-8 pb-8 text-gray-700 leading-relaxed text-lg">
                                ITSA (Information Technology Student Association) adalah sebuah platform/komunitas yang mewadahi mahasiswa atau individu yang tertarik pada bidang teknologi informasi. ITSA berfokus pada pengembangan skill, kolaborasi, dan inovasi di dunia IT melalui berbagai kegiatan edukatif dan kompetitif.
                            </div>
                        </div>
                    </div>

                    <!-- Question 2 -->
                    <div class="bg-white/95 backdrop-blur-sm border border-[#016DAE]/10 rounded-2xl overflow-hidden hover:shadow-lg hover:shadow-[#016DAE]/10 transition-all duration-300 hover:-translate-y-1">
                        <button class="w-full px-8 py-8 text-left hover:bg-blue-50/50 transition-all duration-300 flex items-center justify-between group" onclick="toggleAccordion('q2')">
                            <span class="font-semibold text-xl text-[#016DAE]">Saya mengalami error saat login/daftar, apa yang harus saya lakukan?</span>
                            <svg class="w-6 h-6 transform transition-transform duration-300 text-[#00ADE5]" id="q2-icon" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7 10l5 5 5-5z"/>
                            </svg>
                        </button>
                        <div id="q2-content" class="overflow-hidden transition-all duration-500 ease-in-out max-h-0">
                            <div class="px-8 pb-8 text-gray-700 leading-relaxed text-lg">
                                Pastikan koneksi internetmu stabil dan informasi yang kamu masukkan sudah benar. Jika masalah masih terjadi, coba refresh halaman atau gunakan browser lain. Kamu juga bisa menghubungi tim ITSA melalui halaman <strong class="text-[#016DAE]">Kontak</strong>.
                            </div>
                        </div>
                    </div>

                    <!-- Question 3 -->
                    <div class="bg-white/95 backdrop-blur-sm border border-[#016DAE]/10 rounded-2xl overflow-hidden hover:shadow-lg hover:shadow-[#016DAE]/10 transition-all duration-300 hover:-translate-y-1">
                        <button class="w-full px-8 py-8 text-left hover:bg-blue-50/50 transition-all duration-300 flex items-center justify-between group" onclick="toggleAccordion('q3')">
                            <span class="font-semibold text-xl text-[#016DAE]">Apakah ITSA berbayar atau gratis?</span>
                            <svg class="w-6 h-6 transform transition-transform duration-300 text-[#00ADE5]" id="q3-icon" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7 10l5 5 5-5z"/>
                            </svg>
                        </button>
                        <div id="q3-content" class="overflow-hidden transition-all duration-500 ease-in-out max-h-0">
                            <div class="px-8 pb-8 text-gray-700 leading-relaxed text-lg">
                                Sebagian besar layanan dan kegiatan ITSA disediakan secara <strong class="text-[#016DAE]">gratis</strong>. Namun, beberapa program atau pelatihan khusus mungkin memerlukan kontribusi biaya tertentu, yang akan diinformasikan secara transparan.
                            </div>
                        </div>
                    </div>

                    <!-- Question 4 -->
                    <div class="bg-white/95 backdrop-blur-sm border border-[#016DAE]/10 rounded-2xl overflow-hidden hover:shadow-lg hover:shadow-[#016DAE]/10 transition-all duration-300 hover:-translate-y-1">
                        <button class="w-full px-8 py-8 text-left hover:bg-blue-50/50 transition-all duration-300 flex items-center justify-between group" onclick="toggleAccordion('q4')">
                            <span class="font-semibold text-xl text-[#016DAE]">Kegiatan apa saja yang biasanya dilakukan oleh ITSA?</span>
                            <svg class="w-6 h-6 transform transition-transform duration-300 text-[#00ADE5]" id="q4-icon" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7 10l5 5 5-5z"/>
                            </svg>
                        </button>
                        <div id="q4-content" class="overflow-hidden transition-all duration-500 ease-in-out max-h-0">
                            <div class="px-8 pb-8 text-gray-700 leading-relaxed text-lg">
                                ITSA menyelenggarakan berbagai kegiatan seperti:
                                <ul class="list-disc list-inside mt-4 space-y-2 ml-4">
                                    <li>Pelatihan dan workshop (coding, desain, networking, dsb.)</li>
                                    <li>Webinar dan talkshow dengan narasumber profesional</li>
                                    <li>Lomba dan kompetisi IT</li>
                                    <li>Kolaborasi proyek antaranggota</li>
                                    <li>Forum diskusi dan mentoring</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- By Categories -->
            <div class="mb-20">
                <div class="flex items-center mb-10">
                    <div class="w-1 h-12 bg-gradient-to-b from-[#016DAE] to-[#00ADE5] rounded-full mr-4"></div>
                    <h2 class="text-3xl font-bold text-[#016DAE]">Berdasarkan Kategori</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Account Category -->
                    <button class="bg-white/95 backdrop-blur-sm border border-[#016DAE]/10 rounded-2xl p-10 text-center group hover:shadow-lg hover:shadow-[#016DAE]/10 transition-all duration-300 hover:-translate-y-1 hover:bg-blue-50/50" onclick="showCategory('account')">
                        <div class="w-16 h-16 mx-auto mb-6">
                            <svg fill="#016DAE" viewBox="0 0 24 24" class="w-full h-full">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl text-[#016DAE] group-hover:text-[#00ADE5] transition-colors">Akun</h3>
                    </button>

                    <!-- Security Category -->
                    <button class="bg-white/95 backdrop-blur-sm border border-[#016DAE]/10 rounded-2xl p-10 text-center group hover:shadow-lg hover:shadow-[#016DAE]/10 transition-all duration-300 hover:-translate-y-1 hover:bg-blue-50/50" onclick="showCategory('security')">
                        <div class="w-16 h-16 mx-auto mb-6">
                            <svg fill="#016DAE" viewBox="0 0 24 24" class="w-full h-full">
                                <path d="M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1M12,7C13.4,7 14.8,8.6 14.8,10V11H15.5C16.4,11 17,11.4 17,12V16C17,16.6 16.6,17 16,17H8C7.4,17 7,16.6 7,16V12C7,11.4 7.4,11 8,11H8.5V10C8.5,8.6 9.6,7 12,7M12,8.2C10.2,8.2 9.8,9.2 9.8,10V11H14.2V10C14.2,9.2 13.8,8.2 12,8.2Z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl text-[#016DAE] group-hover:text-[#00ADE5] transition-colors">Keamanan</h3>
                    </button>

                    <!-- Features Category -->
                    <button class="bg-white/95 backdrop-blur-sm border border-[#016DAE]/10 rounded-2xl p-10 text-center group hover:shadow-lg hover:shadow-[#016DAE]/10 transition-all duration-300 hover:-translate-y-1 hover:bg-blue-50/50" onclick="showCategory('features')">
                        <div class="w-16 h-16 mx-auto mb-6">
                            <svg fill="#016DAE" viewBox="0 0 24 24" class="w-full h-full">
                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl text-[#016DAE] group-hover:text-[#00ADE5] transition-colors">Fitur</h3>
                    </button>

                    <!-- Terms of Use Category -->
                    <button class="bg-white/95 backdrop-blur-sm border border-[#016DAE]/10 rounded-2xl p-10 text-center group hover:shadow-lg hover:shadow-[#016DAE]/10 transition-all duration-300 hover:-translate-y-1 hover:bg-blue-50/50" onclick="showCategory('terms')">
                        <div class="w-16 h-16 mx-auto mb-6">
                            <svg fill="#016DAE" viewBox="0 0 24 24" class="w-full h-full">
                                <path d="M9 11h6v2H9v-2zm0-4h6v2H9V7zm11-3h-4.18C15.4 2.84 14.3 2 13 2h-2c-1.3 0-2.4.84-2.82 2H4c-1.1 0-2 .9-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6c0-1.1-.9-2-2-2zM11 4h2v2h-2V4zm9 16H4V6h16v14z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl text-[#016DAE] group-hover:text-[#00ADE5] transition-colors">Syarat Penggunaan</h3>
                    </button>


                   <!-- Activities Category -->
                    <button class="bg-white/95 backdrop-blur-sm border border-[#016DAE]/10 rounded-2xl p-10 text-center group hover:shadow-lg hover:shadow-[#016DAE]/10 transition-all duration-300 hover:-translate-y-1 hover:bg-blue-50/50" onclick="showCategory('activities')">
                        <div class="w-16 h-16 mx-auto mb-6">
                            <svg fill="#016DAE" viewBox="0 0 24 24" class="w-full h-full">
                                <path d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1V2h-2v2H8V2H6v2zm0 16H5V10h14v10zm0-12H5V6h14v2zm-7 9.5l-2.5-2.5 1.06-1.06L12 14.88l3.44-3.44 1.06 1.06L12 17.5z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl text-[#016DAE] group-hover:text-[#00ADE5] transition-colors">Kegiatan</h3>
                    </button>


                    <!-- Feedback Category -->
                    <button class="bg-white/95 backdrop-blur-sm border border-[#016DAE]/10 rounded-2xl p-10 text-center group hover:shadow-lg hover:shadow-[#016DAE]/10 transition-all duration-300 hover:-translate-y-1 hover:bg-blue-50/50" onclick="showCategory('feedback')">
                        <div class="w-16 h-16 mx-auto mb-6">
                            <svg fill="#016DAE" viewBox="0 0 24 24" class="w-full h-full">
                                <path d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10Z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl text-[#016DAE] group-hover:text-[#00ADE5] transition-colors">Umpan Balik</h3>
                    </button>
                </div>
            </div>

            <!-- Category Modal -->
            <div id="categoryModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="bg-white border border-[#016DAE]/20 rounded-3xl max-w-2xl w-full max-h-[80vh] overflow-y-auto shadow-2xl shadow-[#016DAE]/30">
                        <div class="p-10">
                            <div class="flex justify-between items-center mb-8">
                                <h3 id="categoryTitle" class="text-4xl font-bold bg-gradient-to-r from-[#016DAE] to-[#00ADE5] bg-clip-text text-transparent"></h3>
                                <button onclick="closeCategory()" class="text-gray-400 hover:text-[#016DAE] transition-colors">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                                    </svg>
                                </button>
                            </div>
                            <div id="categoryContent" class="space-y-8"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleAccordion(id) {
            const content = document.getElementById(id + '-content');
            const icon = document.getElementById(id + '-icon');
            
            // Close all other accordions
            document.querySelectorAll('[id$="-content"]').forEach(el => {
                if (el.id !== id + '-content') {
                    el.style.maxHeight = '0px';
                    const otherIcon = document.getElementById(el.id.replace('-content', '-icon'));
                    if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                }
            });
            
            // Toggle current accordion
            if (content.style.maxHeight === '0px' || !content.style.maxHeight) {
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.style.transform = 'rotate(180deg)';
            } else {
                content.style.maxHeight = '0px';
                icon.style.transform = 'rotate(0deg)';
            }
        }

        function showCategory(category) {
            const modal = document.getElementById('categoryModal');
            const title = document.getElementById('categoryTitle');
            const content = document.getElementById('categoryContent');
            
            const categoryData = {
                account: {
                    title: 'Akun',
                    questions: [
                        {
                            q: 'Saya lupa password akun saya. Bagaimana cara meresetnya?',
                            a: 'Kamu bisa klik tombol "Lupa Password?" di halaman login. Masukkan email yang terdaftar, lalu ikuti instruksi yang dikirimkan ke email tersebut untuk mengganti password kamu.'
                        },
                        {
                            q: 'Apakah saya bisa mengubah data akun saya setelah mendaftar?',
                            a: 'Ya, kamu bisa mengubah data seperti nama, email, dan foto profil melalui menu "Pengaturan Akun" setelah login. Jika ada kendala, silakan hubungi admin ITSA melalui kontak yang tersedia.'
                        }
                    ]
                },
                security: {
                    title: 'Keamanan',
                    questions: [
                        {
                            q: 'Apakah data saya aman di ITSA?',
                            a: 'Ya, ITSA menggunakan enkripsi dan protokol keamanan terkini untuk melindungi data pengguna. Kami berkomitmen menjaga privasi dan keamanan informasi Anda.'
                        }
                    ]
                },
                features: {
                    title: 'Fitur',
                    questions: [
                        {
                            q: 'Apakah website ITSA bisa diakses lewat HP?',
                            a: 'Ya, website ITSA dirancang dengan desain responsif, sehingga dapat diakses dengan baik melalui desktop, tablet, maupun smartphone.'
                        }
                    ]
                },
                terms: {
                    title: 'Syarat Penggunaan',
                    questions: [
                        {
                            q: 'Apa saja aturan yang harus diikuti anggota ITSA?',
                            a: 'Anggota ITSA diharapkan menjaga etika komunikasi, menghormati sesama anggota, dan tidak melakukan aktivitas yang merugikan komunitas.'
                        }
                    ]
                },
                activities: {
                    title: 'Kegiatan',
                    questions: [
                        {
                            q: 'Apa tujuan utama ITSA dibentuk?',
                            a: 'Tujuan utama ITSA adalah untuk menjadi wadah belajar, berbagi, dan berkembang bersama di bidang teknologi informasi. ITSA mendorong kolaborasi antaranggota, memperluas wawasan teknologi, serta membentuk generasi yang siap bersaing di dunia digital.'
                        }
                    ]
                },
                feedback: {
                    title: 'Umpan Balik',
                    questions: [
                        {
                            q: 'Bagaimana cara menghubungi tim ITSA jika saya punya pertanyaan lain?',
                            a: 'Silakan kunjungi halaman Kontak Kami di website ITSA, atau kirim pesan langsung ke email/akun media sosial resmi yang tertera di footer halaman.'
                        },
                        {
                            q: 'Di mana saya bisa mendapatkan info terbaru dari ITSA?',
                            a: 'Kamu bisa mendapatkan informasi terbaru melalui: Website resmi ITSA (halaman Berita atau Pengumuman), Akun media sosial ITSA (Instagram, LinkedIn, dsb.), Email newsletter (jika tersedia)'
                        },
                        {
                            q: 'Apakah ITSA punya komunitas di media sosial?',
                            a: 'Ya, ITSA aktif di berbagai media sosial seperti Instagram, Twitter, dan LinkedIn. Silakan follow akun-akun tersebut untuk mendapatkan update kegiatan, tips teknologi, dan info menarik lainnya.'
                        }
                    ]
                }
            };

            const data = categoryData[category];
            title.textContent = data.title;
            
            content.innerHTML = data.questions.map(item => `
                <div class="border-b border-gray-200 pb-8 last:border-b-0">
                    <h4 class="font-semibold text-[#016DAE] mb-4 text-xl">${item.q}</h4>
                    <p class="text-gray-700 leading-relaxed text-lg">${item.a}</p>
                </div>
            `).join('');
            
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeCategory() {
            const modal = document.getElementById('categoryModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.getElementById('categoryModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCategory();
            }
        });
    </script>
</div>
</x-app-layout>