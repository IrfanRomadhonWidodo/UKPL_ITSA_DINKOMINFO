<x-app-layout>
    <div class="min-h-screen py-12" style="background: linear-gradient(to bottom right, #E0F7FE, #F0FAFD);">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Section -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-16 h-16" style="background-color: #D3F2FA; border-radius: 9999px; margin-bottom: 1rem;">
                    <svg class="w-8 h-8" fill="none" stroke="#00ADE5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $document['title'] }}</h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Unduh dokumen resmi yang berisi informasi lengkap mengenai syarat dan ketentuan yang berlaku.
                </p>
            </div>

            <!-- Main Content Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Document Preview Section -->
                <div class="px-8 py-12 text-white" style="background: linear-gradient(to right, #016DAE, #00ADE5);">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold mb-2">{{ $document['filename'] }}</h2>
                                <p class="text-white/90 text-sm">Format: PDF • Ukuran: {{ $document['size'] }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-white/80 text-sm">Terakhir diperbarui</p>
                            <p class="text-white font-semibold">{{ $document['updated_at'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- PDF Preview & Document Information Side by Side -->
                <div class="px-8 py-8">
                    <div class="grid md:grid-cols-2 gap-8 items-start">

                        <!-- PDF Preview -->
                        <div class="w-full h-full min-h-[700px]">
                            <iframe src="{{ asset('pdf/' . $document['filename']) }}"
                                class="w-full h-full rounded-xl shadow-md border" frameborder="0"></iframe>
                        </div>

                        <!-- Document Information -->
                        <div>
                            <!-- Tentang Dokumen -->
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Tentang Dokumen</h3>
                            <p class="text-gray-600 leading-relaxed mb-6">
                                {{ $document['description'] }}
                            </p>

                            <!-- Informasi Penting -->
                            <div class="rounded-lg p-6 mb-6" style="background-color: #E6F9FD;">
                                <h4 class="text-lg font-semibold text-[#016DAE] mb-3">Informasi Penting</h4>
                                <ul class="space-y-2 text-[#016DAE]">
                                    @foreach ([
                                        'Dokumen ini bersifat resmi dan mengikat',
                                        'Harap dibaca dengan seksama',
                                        'Untuk keperluan resmi ITSA',
                                    ] as $info)
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 mt-0.5 mr-2 flex-shrink-0 text-[#00ADE5]" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $info }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Detail Dokumen -->
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Detail Dokumen</h3>
                            <div class="space-y-4">
                                @foreach ([
                                    ['label' => 'Nama File:', 'value' => $document['filename']],
                                    ['label' => 'Ukuran File:', 'value' => $document['size']],
                                    ['label' => 'Format:', 'value' => 'PDF'],
                                    ['label' => 'Terakhir Diperbarui:', 'value' => $document['updated_at']],
                                ] as $item)
                                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                        <span class="text-gray-600">{{ $item['label'] }}</span>
                                        <span class="font-semibold text-gray-900">{{ $item['value'] }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Tombol Unduh -->
                            <div class="mt-8">
                                <a href="{{ route('download.file') }}"
                                class="w-full text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center space-x-3"
                                style="background: linear-gradient(to right, #016DAE, #00ADE5);">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span>Unduh Dokumen</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            </div>
        </div>
    </div>
</x-app-layout>
