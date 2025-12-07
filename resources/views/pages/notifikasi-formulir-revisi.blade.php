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
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Detail Formulir & Revisi</h4>
                        
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
                                </div>
                            </div>

                            <!-- Balasan Admin -->
                            @if($notifikasi->formulir && $notifikasi->formulir->balasan_admin)
                            <div class="bg-orange-50 rounded-lg p-4">
                                <h5 class="font-medium text-orange-900 mb-2">Catatan Revisi dari Admin</h5>
                                <p class="text-sm text-orange-800 whitespace-pre-wrap">{{ $notifikasi->formulir->balasan_admin }}</p>
                                <p class="text-xs text-orange-600 mt-2">
                                    Dibalas: {{ $notifikasi->formulir->updated_at->format('d M Y, H:i') }}
                                </p>
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
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$notifikasi->formulir->status ?? 'menunggu'] }}">
                                    {{ ucfirst($notifikasi->formulir->status ?? 'menunggu') }}
                                </span>
                            </div>

                            <!-- Instruksi Tindak Lanjut -->
                            <div class="bg-blue-50 rounded-lg p-4 border-l-4 border-blue-400">
                                <h5 class="font-medium text-blue-900 mb-2">Tindak Lanjut</h5>
                                <p class="text-sm text-blue-800">
                                    Silakan lakukan revisi sesuai dengan catatan admin di atas, kemudian kirim kembali formulir yang telah diperbaiki.
                                </p>
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
                            @if($notifikasi->formulir && $notifikasi->formulir->status === 'revisi')
                            <a href="{{ route('formulir.index') }}" 
                               class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition">
                                Isi Ulang Formulir
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>