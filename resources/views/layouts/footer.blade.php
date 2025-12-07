<footer class="bg-gradient-to-r from-[#00ADE5] to-[#016DAE] text-white pt-12 pb-6 relative overflow-hidden">
    <div class="absolute bottom-0 left-0 right-0 h-20">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-full">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" 
                  opacity=".15" 
                  fill="#FFFFFF"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" 
                  opacity=".15" 
                  fill="#FFFFFF"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" 
                  opacity=".15" 
                  fill="#FFFFFF"></path>
        </svg>
    </div>
    <!-- Background elegan di belakang logo -->
    <div class="absolute -top-20 -left-20 w-64 h-64 opacity-20">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="#FFFFFF" d="M45.2,-58.2C58.3,-46.2,68.4,-30.9,72.2,-13.9C75.9,3.1,73.3,21.8,62.2,36.2C51.1,50.6,31.5,60.6,10.8,67.3C-9.9,73.9,-21.7,77.1,-36.3,70.8C-50.9,64.5,-68.3,48.6,-74.1,29.6C-79.9,10.6,-74.1,-11.5,-62.8,-29.8C-51.5,-48.1,-34.7,-62.6,-16.8,-68.2C1.1,-73.8,20.1,-70.5,45.2,-58.2Z" transform="translate(100 100)"/>
        </svg>
    </div>
    <div class="absolute -top-20  -right-10 w-64 h-64 opacity-15">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="#FFFFFF" d="M48.5,-56.3C62.4,-45.3,73.2,-30.4,76.5,-14.1C79.8,2.2,75.6,19.9,64.3,34.8C53,49.7,34.6,61.8,14.3,70.2C-6.1,78.6,-28.3,83.2,-44.3,73.8C-60.3,64.3,-70,40.8,-73.7,18.5C-77.5,-3.8,-75.3,-25,-62.8,-39.3C-50.3,-53.6,-27.6,-61.1,-5.4,-58.2C16.8,-55.3,33.6,-42.1,48.5,-56.3Z" transform="translate(100 100)"/>
        </svg>
    </div>

    <div class="container mx-auto px-6 md:px-10 grid grid-cols-1 md:grid-cols-4 gap-8 relative z-10">
        <!-- Area Logo dengan Desain Elegan -->
        <div class="relative group">
            <!-- Efek lingkaran dekoratif -->
            <div class="absolute -z-10 -inset-3 bg-white/10 rounded-full blur-md opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            
            <div class="flex justify-center items-center gap-x-10 px-4 py-4">
                <img src="{{ asset('image/logo_banyumas.png') }}" alt="Logo Banyumas"
                    class="h-16 transition-transform duration-300 hover:scale-110" />
                <img src="{{ asset('image/LOGO_BARU.png') }}" alt="Logo ITSA"
                    class="h-16 transition-transform duration-300 hover:scale-110" />
            </div>
        </div>

        <!-- Kolom: Tentang ITSA -->
        <div>
            <h4 class="font-bold text-lg mb-3">Tentang ITSA</h4>
            <ul class="space-y-1 text-sm text-white/90">
                <li><a href="{{ route('profil-itsa') }}" class="hover:underline hover:text-white">Profil ITSA</a></li>
                <li><a href="{{ route('panduan') }}" class="hover:underline hover:text-white">Panduan Penggunaan</a></li>
                <li><a href="{{ route('faq') }}" class="hover:underline hover:text-white">FAQ</a></li>
            </ul>
        </div>

        <!-- Kolom: Layanan -->
        <div>
            <h4 class="font-bold text-lg mb-3">Layanan</h4>
            <ul class="space-y-1 text-sm text-white/90">
                <li><a href="{{ route('alur-layanan') }}" class="hover:underline hover:text-white">Alur Layanan</a></li>
                <li><a href="{{ route('formulir.index') }}" class="hover:underline hover:text-white">Formulir</a></li>
                <li><a href="{{ route('riwayat.index') }}" class="hover:underline hover:text-white">Riwayat</a></li>
                <li><a href="{{ route('download') }}" class="hover:underline hover:text-white">Dokumen S&K</a></li>
            </ul>
        </div>

        <!-- Kolom: Navigasi Utama -->
        <div>
            <h4 class="font-bold text-lg mb-3">Navigasi</h4>
            <ul class="space-y-1 text-sm text-white/90">
                <li><a href="{{ route('dashboard') }}" class="hover:underline hover:text-white">Beranda</a></li>
                <li><a href="{{ route('kontak') }}" class="hover:underline hover:text-white">Kontak</a></li>
                <li><a href="{{ route('notifikasi.index') }}" class="hover:underline hover:text-white">Notifikasi</a></li>
            </ul>
        </div>
    </div>

    <!-- Bagian Bawah -->
    <div class="border-t border-white/20 mt-12 pt-6 relative z-10">
        <div class="container mx-auto px-6 md:px-10 flex flex-col md:flex-row justify-between items-center text-sm text-white/80">
            <!-- Media Sosial -->
            <div class="flex space-x-4 mb-4 md:mb-0 text-xl">
                <a href="https://www.youtube.com/@BETTERBANYUMAS" class="hover:text-white transition-colors"><i class="fab fa-youtube"></i></a>
                <a href="https://www.instagram.com/dinkominfo_kab.banyumas/" class="hover:text-white transition-colors"><i class="fab fa-instagram"></i></a>
                <a href="https://x.com/kominfobanyumas" class="hover:text-white transition-colors"><i class="fab fa-x-twitter"></i></a>
            </div>
            <!-- Hak Cipta -->
            <div class="flex flex-wrap justify-center gap-4 md:gap-6 text-center">
                <a href="#" class="hover:underline hover:text-white">© 2025 ITSA</a>
                <a href="#" class="hover:underline hover:text-white">Dinas Komunikasi dan Informatika Kabupaten Banyumas</a>
                <a href="#" class="hover:underline hover:text-white">Hak Cipta Dilindungi</a>
            </div>
        </div>
    </div>
</footer>