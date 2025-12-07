<x-app-layout>
<div class="py-12 bg-[#E0F7FE]">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $notifikasi->judul }}</h3>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ $notifikasi->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>

                    <div class="prose max-w-none">
                        <p class="text-gray-700">{{ $notifikasi->pesan }}</p>
                    </div>

                    @if($notifikasi->formulir_id)
                    <div class="mt-8 border-t pt-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Detail Formulir & File Hasil</h4>
                        
                        <div class="space-y-6">
                            <!-- Informasi Formulir -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h5 class="font-medium text-gray-900 mb-2">Informasi Formulir</h5>
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Nama Aplikasi:</span> {{ $notifikasi->formulir->nama_aplikasi ?? 'Tidak tersedia' }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Domain Aplikasi:</span> {{ $notifikasi->formulir->domain_aplikasi ?? 'Tidak tersedia' }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Tanggal Pengajuan:</span> {{ $notifikasi->formulir->created_at->format('d M Y, H:i') ?? 'Tidak tersedia' }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Tanggal Selesai:</span> {{ $notifikasi->formulir->updated_at->format('d M Y, H:i') ?? 'Tidak tersedia' }}
                                    </p>
                                </div>
                            </div>

                            <!-- File Hasil ITSA -->
                            @if($notifikasi->formulir && $notifikasi->formulir->file_hasil_itsa)
                            <div class="bg-green-50 rounded-lg p-4">
                                <h5 class="font-medium text-green-900 mb-2">File Hasil ITSA</h5>
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                            <path d="M9 8a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"/>
                                            <path d="M9 6a1 1 0 011-1h1a1 1 0 110 2H10a1 1 0 01-1-1z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-green-800 font-medium">
                                            {{ basename($notifikasi->formulir->file_hasil_itsa) }}
                                        </p>
                                        <p class="text-xs text-green-600">
                                            File hasil ITSA siap untuk diunduh
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="{{ Storage::url($notifikasi->formulir->file_hasil_itsa) }}" 
                                           target="_blank"
                                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Unduh
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Status -->
                            <div class="flex items-center space-x-2">
                                <span class="text-sm font-medium text-gray-700">Status:</span>
                                @php
                                    $statusColors = [
                                        'menunggu' => 'bg-yellow-100 text-yellow-800',
                                        'revisi' => 'bg-orange-100 text-orange-800',
                                        'selesai' => 'bg-green-100 text-green-800'
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$notifikasi->formulir->status ?? 'selesai'] }}">
                                    {{ ucfirst($notifikasi->formulir->status ?? 'selesai') }}
                                </span>
                            </div>

                            <!-- Pesan Selesai -->
                            <div class="bg-green-50 rounded-lg p-4 border-l-4 border-green-400">
                                <h5 class="font-medium text-green-900 mb-2">Proses Selesai</h5>
                                <p class="text-sm text-green-800">
                                    Proses ITSA untuk aplikasi "{{ $notifikasi->formulir->nama_aplikasi }}" telah selesai. 
                                    Silakan unduh file hasil ITSA di atas.
                                </p>
                            </div>

                            <!-- Informasi Tambahan -->
                            <div class="bg-blue-50 rounded-lg p-4">
                                <h5 class="font-medium text-blue-900 mb-2">Informasi Penting</h5>
                                <ul class="text-sm text-blue-800 space-y-1">
                                    <li>• Silakan simpan file hasil ITSA dengan baik</li>
                                    <li>• Jika ada kendala dengan file, silakan hubungi admin</li>
                                    <li>• File dapat diunduh berkali-kali jika diperlukan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="mt-8 flex justify-between items-center">
                        <a href="{{ route('notifikasi.index') }}" 
                           class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                            Kembali ke Notifikasi
                        </a>
                        
                        <div class="flex space-x-3">
                            @if($notifikasi->formulir && $notifikasi->formulir->file_hasil_itsa)
                            <a href="{{ Storage::url($notifikasi->formulir->file_hasil_itsa) }}" 
                               target="_blank"
                               class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                                Unduh File Hasil
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>