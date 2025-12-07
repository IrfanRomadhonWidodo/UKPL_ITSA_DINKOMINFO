<x-app-admin>
    <div id="modalBackdrop" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-40 hidden"></div>

    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Manajemen Formulir</h2>
            <p class="text-gray-600 mt-1">Kelola formulir aplikasi dari pengguna</p>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <span class="text-sm font-medium text-gray-700">Total: <span class="text-orange-400">{{ $formulirs->total() }}</span> formulir</span>
                    </div>
                </div>
                <form action="{{ route('admin.formulir.index') }}" method="GET" class="flex items-center space-x-3">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari formulir..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-64"
                            value="{{ request('search') }}">
                        <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <select name="status" class="pl-3 pr-8 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Status</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="revisi" {{ request('status') == 'revisi' ? 'selected' : '' }}>Revisi</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Cari
                    </button>
                    @if(request('search') || request('status'))
                    <a href="{{ route('admin.formulir.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                        Reset
                    </a>
                    @endif
                </form>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-[#EDBC19] to-[#8F181A]">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Pengguna</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Aplikasi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Domain</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Balasan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">File ITSA</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($formulirs as $formulir)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $formulir->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $formulir->user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $formulir->nama_aplikasi }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $formulir->domain_aplikasi }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($formulir->balasan_admin)
                                <div class="text-sm text-gray-900">{{ Str::limit($formulir->balasan_admin, 50) }}</div>
                            @else
                                <span class="text-sm text-gray-400 italic">Belum ada balasan</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($formulir->file_hasil_itsa)
                                <a href="{{ Storage::url($formulir->file_hasil_itsa) }}" target="_blank" class="text-blue-600 hover:text-blue-900 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Lihat File
                                </a>
                            @else
                                <span class="text-sm text-gray-400 italic">Belum ada file</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'diproses' => 'bg-blue-100 text-blue-800',
                                    'revisi' => 'bg-orange-100 text-orange-800',
                                    'selesai' => 'bg-green-100 text-green-800'
                                ];
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$formulir->status] }}">
                                {{ ucfirst($formulir->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $formulir->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <button onclick="openModal('viewFormulirModal{{ $formulir->id }}')" class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <button onclick="openModal('replyFormulirModal{{ $formulir->id }}')" class="text-green-600 hover:text-green-900" title="Balas">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                    </svg>
                                </button>
                                <button onclick="openModal('uploadFileModal{{ $formulir->id }}')" class="text-purple-600 hover:text-purple-900" title="Upload File">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                </button>
                                <form id="delete-form-{{ $formulir->id }}" action="{{ route('admin.formulir.destroy', $formulir->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteFormulir({{ $formulir->id }})" class="text-red-600 hover:text-red-900" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

<!-- Modal View Formulir - Improved Version -->
<div id="viewFormulirModal{{ $formulir->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-6xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-gradient-to-r from-[#EDBC19] to-[#8F181A] px-6 py-4 rounded-t-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-white">Detail Formulir Aplikasi</h3>
                    <p class="text-white/80 text-sm mt-1">{{ $formulir->nama_aplikasi }}</p>
                </div>
                <button onclick="closeModal('viewFormulirModal{{ $formulir->id }}')" class="text-white/80 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Content -->
        <div class="px-6 py-6">
            <!-- Status Badge -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                    @php
                        $statusColors = [
                            'diproses' => 'bg-blue-100 text-blue-800 border-blue-200',
                            'revisi' => 'bg-orange-100 text-orange-800 border-orange-200',
                            'selesai' => 'bg-green-100 text-green-800 border-green-200'
                        ];
                    @endphp
                    <span class="px-4 py-2 text-sm font-semibold rounded-full border {{ $statusColors[$formulir->status] }}">
                        {{ ucfirst($formulir->status) }}
                    </span>
                </div>
                <div class="text-sm text-gray-500">
                    <span class="font-medium">Dibuat:</span> {{ $formulir->created_at->format('d M Y, H:i') }}
                </div>
            </div>

            <!-- Content Sections -->
            <div class="space-y-6">
                
                <!-- Section 1: Informasi Pengguna -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">Informasi Pengguna</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <div class="flex">
                                <span class="font-medium text-gray-600 w-16">Nama:</span>
                                <span class="text-gray-900">{{ $formulir->user->name }}</span>
                            </div>
                            <div class="flex">
                                <span class="font-medium text-gray-600 w-16">Email:</span>
                                <span class="text-gray-900">{{ $formulir->user->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Informasi Aplikasi -->
                <div class="bg-blue-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">Informasi Aplikasi</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">Nama Aplikasi</span>
                                <span class="text-gray-900 font-semibold">{{ $formulir->nama_aplikasi }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">Domain</span>
                                <span class="text-gray-900">{{ $formulir->domain_aplikasi }}</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">IP Jenis</span>
                                <span class="text-gray-900">{{ $formulir->ip_jenis }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">IP Address</span>
                                <span class="text-gray-900 font-mono">{{ $formulir->ip_address }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Informasi Pejabat -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">Informasi Pejabat</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">Nama Pejabat</span>
                                <span class="text-gray-900 font-semibold">{{ $formulir->pejabat_nama }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">NIP</span>
                                <span class="text-gray-900 font-mono">{{ $formulir->pejabat_nip }}</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">Pangkat</span>
                                <span class="text-gray-900">{{ $formulir->pejabat_pangkat }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">Jabatan</span>
                                <span class="text-gray-900">{{ $formulir->pejabat_jabatan }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Detail Sistem -->
                <div class="bg-blue-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">Detail Sistem</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">Tujuan Sistem</span>
                                <span class="text-gray-900">{{ $formulir->tujuan_sistem }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">Pengguna Sistem</span>
                                <span class="text-gray-900">{{ $formulir->pengguna_sistem }}</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">Hosting</span>
                                <span class="text-gray-900">{{ $formulir->hosting }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">Framework</span>
                                <span class="text-gray-900">{{ $formulir->framework }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 5: Pengelolaan -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">Pengelolaan</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">Pengelola Sistem</span>
                                <span class="text-gray-900">{{ $formulir->pengelola_sistem }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">Jumlah Roles</span>
                                <span class="text-gray-900">{{ $formulir->jumlah_roles }}</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">Nama Roles</span>
                                <span class="text-gray-900">{{ $formulir->nama_roles }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">PIC Pengelola</span>
                                <span class="text-gray-900">{{ $formulir->pic_pengelola }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 6: Keamanan -->
                <div class="bg-blue-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">Keamanan</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">Mekanisme Account</span>
                                <span class="text-gray-900">{{ $formulir->mekanisme_account }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">Mekanisme Kredensial</span>
                                <span class="text-gray-900">{{ $formulir->mekanisme_kredensial }}</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">Fitur Reset Password</span>
                                <span class="text-gray-900">{{ $formulir->fitur_reset_password }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 7: Keterangan Tambahan -->
                @if($formulir->keterangan_tambahan)
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">Keterangan Tambahan</h4>
                    </div>
                    <div class="bg-white p-4 rounded-lg border">
                        <p class="text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $formulir->keterangan_tambahan }}</p>
                    </div>
                </div>
                @endif

                <!-- Section 8: Balasan Admin -->
                @if($formulir->balasan_admin)
                <div class="bg-blue-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">Balasan Admin</h4>
                    </div>
                    <div class="bg-white p-4 rounded-lg border border-blue-200">
                        <p class="text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $formulir->balasan_admin }}</p>
                    </div>
                </div>
                @endif

                <!-- Section 9: File ITSA -->
                @if($formulir->file_hasil_itsa)
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">File Hasil ITSA</h4>
                    </div>
                    <div class="bg-white p-4 rounded-lg border">
                        <a href="{{ Storage::url($formulir->file_hasil_itsa) }}" target="_blank" 
                           class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download File ITSA
                        </a>
                    </div>
                </div>
                @endif

            </div>
        </div>

        <!-- Modal Footer -->
        <div class="sticky bottom-0 bg-white px-6 py-4 border-t border-gray-200 rounded-b-lg">
            <div class="flex justify-end space-x-3">
                <button onclick="closeModal('viewFormulirModal{{ $formulir->id }}')" 
                        class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Reply Formulir -->
<div id="replyFormulirModal{{ $formulir->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white px-6 py-4 border-b border-gray-200 rounded-t-lg">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Balas Revisi Formulir</h3>
                <button onclick="closeModal('replyFormulirModal{{ $formulir->id }}')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <form action="{{ route('admin.formulir.update', $formulir->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="px-6 py-4 space-y-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-medium text-gray-900 mb-2">Formulir dari {{ $formulir->user->name }}</h4>
                    <p class="text-sm text-gray-600"><strong>Aplikasi:</strong> {{ $formulir->nama_aplikasi }}</p>
                    <p class="text-sm text-gray-600"><strong>Domain:</strong> {{ $formulir->domain_aplikasi }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Balasan Admin</label>
                    <textarea name="balasan_admin" rows="4" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Tulis balasan Anda di sini...">{{ $formulir->balasan_admin }}</textarea>
                    <p class="mt-2 text-sm text-gray-500">Status otomatis menjadi “Revisi” setelah balasan dikirim.</p>
                </div>
            </div>

            <div class="sticky bottom-0 bg-white px-6 py-4 border-t border-gray-200 flex space-x-3 rounded-b-lg">
                <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-[#EDBC19] to-[#8F181A] text-white rounded-md hover:opacity-90 transition">
                    Kirim Balasan
                </button>
                <button type="button" onclick="closeModal('replyFormulirModal{{ $formulir->id }}')" class="flex-1 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Upload File -->
<div id="uploadFileModal{{ $formulir->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white px-6 py-4 border-b border-gray-200 rounded-t-lg">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Upload File Hasil ITSA</h3>
                <button onclick="closeModal('uploadFileModal{{ $formulir->id }}')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

  <form action="{{ route('admin.formulir.uploadFile', $formulir->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="px-6 py-4 space-y-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-medium text-gray-900 mb-2">Formulir dari {{ $formulir->user->name }}</h4>
                    <p class="text-sm text-gray-600"><strong>Aplikasi:</strong> {{ $formulir->nama_aplikasi }}</p>
                    <p class="text-sm text-gray-600"><strong>Domain:</strong> {{ $formulir->domain_aplikasi }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">File Hasil ITSA (PDF)</label>
                    <input type="file" name="file_hasil_itsa" accept=".pdf" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="mt-2 text-sm text-gray-500">PDF maks. 10 MB. Status otomatis “Selesai” setelah upload.</p>
                </div>

                @if($formulir->file_hasil_itsa)
                <div class="bg-blue-50 p-4 rounded-lg">
                    <p class="text-sm text-blue-800">
                        File saat ini:
                        <a href="{{ Storage::url($formulir->file_hasil_itsa) }}" target="_blank" class="underline">Lihat File</a>
                    </p>
                </div>
                @endif
            </div>

            <div class="sticky bottom-0 bg-white px-6 py-4 border-t border-gray-200 flex space-x-3 rounded-b-lg">
                <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-[#EDBC19] to-[#8F181A] text-white rounded-md hover:opacity-90 transition">
                    Upload File
                </button>
                <button type="button" onclick="closeModal('uploadFileModal{{ $formulir->id }}')" class="flex-1 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                            Tidak ada formulir yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $formulirs->links() }}
        </div>
    </div>

    @push('scripts')
    <script>
        // Modal handling functions
        function openModal(modalId) {
            document.getElementById('modalBackdrop').classList.remove('hidden');
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById('modalBackdrop').classList.add('hidden');
            document.getElementById(modalId).classList.add('hidden');
        }

        // Close all modals when backdrop is clicked
        document.getElementById('modalBackdrop').addEventListener('click', function() {
            document.querySelectorAll('[id$="Modal"]').forEach(modal => {
                modal.classList.add('hidden');
            });
            this.classList.add('hidden');
        });

        // SweetAlert for success messages
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        // SweetAlert for delete confirmation with backdrop blur
        function deleteFormulir(id) {
            // Show backdrop with blur
            document.getElementById('modalBackdrop').classList.remove('hidden');
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Formulir yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#8F181A',
                cancelButtonColor: '#9ca3af',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                backdrop: false // Don't use SweetAlert's backdrop since we're using our own
            }).then((result) => {
                // Hide backdrop
                document.getElementById('modalBackdrop').classList.add('hidden');
                
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
    @endpush
</x-app-admin>