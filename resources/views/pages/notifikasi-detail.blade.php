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

                    @if($notifikasi->feedback)
                    <div class="mt-8 border-t pt-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Detail Feedback & Balasan</h4>
                        
                        <div class="space-y-6">
                            <!-- Feedback Asli -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h5 class="font-medium text-gray-900 mb-2">Feedback Anda</h5>
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Subjek:</span> {{ $notifikasi->feedback->subjek_label }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Pesan:</span>
                                    </p>
                                    <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $notifikasi->feedback->pesan }}</p>
                                    <p class="text-xs text-gray-500">
                                        Dikirim: {{ $notifikasi->feedback->created_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Balasan Admin -->
                            @if($notifikasi->feedback->balasan_admin)
                            <div class="bg-blue-50 rounded-lg p-4">
                                <h5 class="font-medium text-blue-900 mb-2">Balasan Admin</h5>
                                <p class="text-sm text-blue-800 whitespace-pre-wrap">{{ $notifikasi->feedback->balasan_admin }}</p>
                                <p class="text-xs text-blue-600 mt-2">
                                    Dibalas: {{ $notifikasi->feedback->updated_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                            @endif

                            <!-- Status -->
                            <div class="flex items-center space-x-2">
                                <span class="text-sm font-medium text-gray-700">Status:</span>
                                @php
                                    $statusColors = [
                                        'menunggu' => 'bg-yellow-100 text-yellow-800',
                                        'diproses' => 'bg-blue-100 text-blue-800',
                                        'selesai' => 'bg-green-100 text-green-800'
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$notifikasi->feedback->status] }}">
                                    {{ ucfirst($notifikasi->feedback->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="mt-8 flex justify-between items-center">
                        <a href="{{ route('notifikasi.index') }}" 
                           class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                            Kembali ke Notifikasi
                        </a>
                        
                        @if($notifikasi->feedback && $notifikasi->feedback->status !== 'selesai')
                        <div class="text-sm text-gray-600">
                            <em>Feedback ini masih dalam proses...</em>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>