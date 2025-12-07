<x-app-layout>
    <section class="min-h-screen bg-[#E0F7FE] py-16">
        <div class="max-w-6xl mx-auto px-6 text-center">

            <!-- Header Section -->
            <header class="mb-12">
                <h1 class="text-4xl md:text-5xl font-bold text-[#016DAE] leading-tight mb-3 tracking-tight">
                    Panduan Penggunaan <span class="text-[#00ADE5]">ITSA</span>
                </h1>
                <p class="text-base md:text-lg text-gray-700 max-w-2xl mx-auto">
                    Ikuti langkah-langkah berikut untuk menggunakan layanan ITSA dengan mudah dan aman.
                </p>
            </header>

            <!-- Image Guide -->
            <figure class="overflow-hidden rounded-2xl shadow-xl border border-[#00ADE5] bg-white">
                <img src="{{ asset('image/panduan_penggunaan.png') }}" 
                     alt="Panduan Penggunaan ITSA" 
                     class="w-full h-auto object-cover">
            </figure>

            <!-- Back Button -->
            <div class="mt-14">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#016DAE] to-[#00ADE5] text-white font-medium rounded-xl shadow-md hover:shadow-lg transition transform hover:scale-105">
                    Kembali ke Dashboard
                </a>
            </div>

        </div>
    </section>
</x-app-layout>
