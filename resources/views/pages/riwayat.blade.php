<x-app-layout>


<div class="py-12 bg-[#E0F7FE]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <!-- Header Section -->
                    <div class="mb-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-[#00ADE5] to-[#016DAE] rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Riwayat Pengajuan ITSA</h3>
                                <p class="text-gray-600 text-sm">Lihat status dan detail semua formulir yang telah Anda ajukan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-gradient-to-r from-[#00ADE5] to-[#016DAE] rounded-lg p-4 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-blue-100">Total Pengajuan</p>
                                    <p class="text-2xl font-bold">{{ $formulir->count() }}</p>
                                </div>
                                <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                    <svg class="w-10 h-10" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="24" cy="24" r="20" fill="#2196F3" fill-opacity="0.2" />
                                    <circle cx="24" cy="24" r="12" fill="#FFFFFF"/>
                                    <path d="M24 24l4-8-8 4 4 4z" fill="#1976D2"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-yellow-700">Diproses</p>
                                    <p class="text-2xl font-bold text-yellow-800">{{ $formulir->where('status', 'diproses')->count() }}</p>
                                </div>
                                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-red-700">Perlu Revisi</p>
                                    <p class="text-2xl font-bold text-red-800">{{ $formulir->where('status', 'revisi')->count() }}</p>
                                </div>
                                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-green-700">Selesai</p>
                                    <p class="text-2xl font-bold text-green-800">{{ $formulir->where('status', 'selesai')->count() }}</p>
                                </div>
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-sm text-green-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Table Section -->
                    @if($formulir->count() > 0)
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gradient-to-r from-[#00ADE5] to-[#016DAE]">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                                Aplikasi
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                                Domain
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                                Tanggal Pengajuan
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($formulir as $item)
                                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="w-10 h-10 bg-gradient-to-r from-[#00ADE5] to-[#016DAE] rounded-lg flex items-center justify-center mr-3">
                                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900">{{ $item->nama_aplikasi }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $item->domain_aplikasi }}</div>
                                                    <div class="text-sm text-gray-500">{{ $item->ip_address }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $item->created_at->format('d M Y') }}</div>
                                                    <div class="text-sm text-gray-500">{{ $item->created_at->format('H:i') }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @php
                                                        $badgeClass = App\Http\Controllers\Pages\RiwayatController::getStatusBadgeClass($item->status);
                                                        $statusText = App\Http\Controllers\Pages\RiwayatController::getStatusText($item->status);
                                                    @endphp
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $badgeClass }}">
                                                        {{ $statusText }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <div class="flex space-x-2">
                                                        <!-- Detail Button -->
                                                        <button 
                                                            onclick="showDetail({{ $item->id }})"
                                                            class="inline-flex items-center px-3 py-1 border border-[#00ADE5] text-[#00ADE5] text-xs font-medium rounded-md hover:bg-[#00ADE5] hover:text-white transition-colors duration-200">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                            </svg>
                                                            Detail
                                                        </button>

                                                        <!-- Edit Button (only for diproses/revisi) -->
                                                        @if(in_array($item->status, ['diproses', 'revisi']))
                                                            <button 
                                                                onclick="showEditModal({{ $item->id }})"
                                                                class="inline-flex items-center px-3 py-1 border border-yellow-500 text-yellow-600 text-xs font-medium rounded-md hover:bg-yellow-500 hover:text-white transition-colors duration-200">
                                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                                </svg>
                                                                Edit
                                                            </button>
                                                        @endif

                                                        <!-- Download PDF Button (only for selesai) -->
                                                        @if($item->status === 'selesai' && $item->file_hasil_itsa)
                                                            <a href="{{ route('riwayat.download', $item->id) }}" 
                                                               class="inline-flex items-center px-3 py-1 border border-green-500 text-green-600 text-xs font-medium rounded-md hover:bg-green-500 hover:text-white transition-colors duration-200">
                                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                                </svg>
                                                                PDF
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pengajuan</h3>
                            <p class="text-gray-500 mb-4">Anda belum mengajukan formulir ITSA apapun.</p>
                            <a href="{{ route('formulir.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#00ADE5] to-[#016DAE] text-white text-sm font-medium rounded-md hover:from-[#016DAE] hover:to-[#00ADE5] transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Ajukan Formulir Baru
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


<!-- Detail Modal -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Detail Pengajuan</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="modalContent" class="space-y-4">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
function closeModal() {
    document.getElementById('detailModal').classList.add('hidden');
}

// Example function to show modal
function showModal() {
    document.getElementById('detailModal').classList.remove('hidden');
}

// Example untuk JavaScript yang uniform
function loadModalContent(item, createdAt) {
    const modalContent = document.getElementById('modalContent');
    modalContent.innerHTML = `
        <!-- Status Badge -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-4">
                <span class="px-4 py-2 text-sm font-semibold rounded-full border ${getStatusBadgeClass(item.status)}">
                    ${getStatusText(item.status)}
                </span>
            </div>
            <div class="text-sm text-gray-500">
                <span class="font-medium">Dibuat:</span> ${createdAt}
            </div>
        </div>

        <!-- Content Sections - Semua Rectangle Sama -->
        <div class="space-y-6">
            <!-- Section 1: Informasi Aplikasi -->
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M20 9H4m16 6H4m11-7v8a2 2 0 01-2 2H9a2 2 0 01-2-2V8a2 2 0 012-2h6a2 2 0 012 2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900">Informasi Aplikasi</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-3">
                        <div>
                            <span class="font-medium text-gray-600">Nama Aplikasi:</span>
                            <p class="text-gray-900 mt-1">${item.nama_aplikasi}</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Domain Aplikasi:</span>
                            <p class="text-gray-900 mt-1">${item.domain_aplikasi}</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">IP Address:</span>
                            <p class="text-gray-900 mt-1">${item.ip_address}</p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <span class="font-medium text-gray-600">Hosting:</span>
                            <p class="text-gray-900 mt-1">${item.hosting}</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Framework:</span>
                            <p class="text-gray-900 mt-1">${item.framework}</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Tujuan Sistem:</span>
                            <p class="text-gray-900 mt-1">${item.tujuan_sistem}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Penanggung Jawab -->
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900">Penanggung Jawab</h4>
                </div>
                <div class="space-y-2">
                    <div>
                        <span class="font-medium text-gray-600">Nama:</span>
                        <span class="text-gray-900 ml-2">${item.pejabat_nama}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600">Jabatan:</span>
                        <span class="text-gray-900 ml-2">${item.pejabat_jabatan}</span>
                    </div>
                </div>
            </div>

            <!-- Section 3: Balasan Admin (kalau ada) -->
            ${item.balasan_admin ? `
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">Balasan Admin</h4>
                    </div>
                    <p class="text-gray-900">${item.balasan_admin}</p>
                </div>
            ` : ''}
        </div>
    `;
}

// Example dummy functions
function getStatusBadgeClass(status) {
    const statusColors = {
        'menunggu': 'bg-yellow-100 text-yellow-800 border-yellow-200',
        'diproses': 'bg-blue-100 text-blue-800 border-blue-200',
        'revisi': 'bg-orange-100 text-orange-800 border-orange-200',
        'selesai': 'bg-green-100 text-green-800 border-green-200'
    };
    return statusColors[status] || 'bg-gray-100 text-gray-800 border-gray-200';
}

function getStatusText(status) {
    return status.charAt(0).toUpperCase() + status.slice(1);
}
</script>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 backdrop-blur-sm hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-4/5 lg:w-3/4 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Edit Pengajuan</h3>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div id="editContent" class="space-y-4">
                        <!-- Content will be loaded here -->
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <button type="button" onclick="closeEditModal()" 
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 transition-colors duration-200">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-[#00ADE5] to-[#016DAE] rounded-md hover:from-[#016DAE] hover:to-[#00ADE5] transition-all duration-200">
                            <span class="submit-text">Simpan Perubahan</span>
                            <span class="loading-text hidden">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex items-center space-x-3">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-[#00ADE5]"></div>
                <p class="text-gray-700">Memproses...</p>
            </div>
        </div>
    </div>

    <script>
        function showDetail(id) {
            const formulir = @json($formulir);
            const item = formulir.find(f => f.id === id);
            
            if (!item) return;
            
            const createdAt = new Date(item.created_at).toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
            
            const modalContent = document.getElementById('modalContent');
            modalContent.innerHTML = `
                <!-- Status Badge -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <span class="px-4 py-2 text-sm font-semibold rounded-full border ${getStatusBadgeClass(item.status)}">
                            ${getStatusText(item.status)}
                        </span>
                    </div>
                    <div class="text-sm text-gray-500">
                        <span class="font-medium">Dibuat:</span> ${createdAt}
                    </div>
                </div>

                <!-- Content Sections -->
                <div class="space-y-6">
                    <!-- Section 1: Informasi Aplikasi -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3M4 11h16M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900">Informasi Aplikasi</h4>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-3">
                                <div>
                                    <span class="font-medium text-gray-600">Nama Aplikasi:</span>
                                    <p class="text-gray-900 mt-1">${item.nama_aplikasi}</p>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">Domain Aplikasi:</span>
                                    <p class="text-gray-900 mt-1">${item.domain_aplikasi}</p>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">IP Address:</span>
                                    <p class="text-gray-900 mt-1">${item.ip_address}</p>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div>
                                    <span class="font-medium text-gray-600">Hosting:</span>
                                    <p class="text-gray-900 mt-1">${item.hosting}</p>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">Framework:</span>
                                    <p class="text-gray-900 mt-1">${item.framework}</p>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">Tujuan Sistem:</span>
                                    <p class="text-gray-900 mt-1">${item.tujuan_sistem}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Penanggung Jawab -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900">Penanggung Jawab</h4>
                        </div>
                        <div class="space-y-2">
                            <div>
                                <span class="font-medium text-gray-600">Nama:</span>
                                <span class="text-gray-900 ml-2">${item.pejabat_nama}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-600">Jabatan:</span>
                                <span class="text-gray-900 ml-2">${item.pejabat_jabatan}</span>
                            </div>
                        </div>
                    </div>
                </div>

                ${item.balasan_admin ? `
                    <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 bg-yellow-200 rounded-full flex items-center justify-center mr-2">
                                <svg class="w-3 h-3 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <h4 class="font-medium text-yellow-800">Balasan Admin</h4>
                        </div>
                        <p class="text-sm text-yellow-700">${item.balasan_admin}</p>
                    </div>
                ` : ''}
            `;
            
            document.getElementById('detailModal').classList.remove('hidden');
        }
        
        function showEditModal(id) {
        const formulir = @json($formulir);
        const item = formulir.find(f => f.id === id);
        
        if (!item) return;
        
        const editForm = document.getElementById('editForm');
        editForm.action = `/riwayat/${id}`;
        
        const editContent = document.getElementById('editContent');
        editContent.innerHTML = `
            <!-- Status Badge -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                    <span class="px-4 py-2 text-sm font-semibold rounded-full border ${getStatusBadgeClass(item.status)}">
                        ${getStatusText(item.status)}
                    </span>
                </div>
            </div>

            <!-- Content Sections -->
            <div class="space-y-6">
                <!-- Section 1: Informasi Aplikasi -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3M4 11h16M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">Informasi Aplikasi</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Aplikasi <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_aplikasi" value="${item.nama_aplikasi}" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Domain Aplikasi</label>
                                <input type="text" name="domain_aplikasi" value="${item.domain_aplikasi || ''}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis IP</label>
                                <select name="ip_jenis"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">
                                    <option value="">Pilih Jenis IP</option>
                                    <option value="lokal" ${item.ip_jenis === 'lokal' ? 'selected' : ''}>Lokal</option>
                                    <option value="public" ${item.ip_jenis === 'public' ? 'selected' : ''}>Publik</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">IP Address</label>
                                <input type="text" name="ip_address" value="${item.ip_address || ''}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Hosting</label>
                                <input type="text" name="hosting" value="${item.hosting || ''}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Framework</label>
                                <input type="text" name="framework" value="${item.framework || ''}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tujuan Sistem</label>
                                <textarea name="tujuan_sistem" rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">${item.tujuan_sistem || ''}</textarea>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pengguna Sistem</label>
                                <input type="text" name="pengguna_sistem" value="${item.pengguna_sistem || ''}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pengelola Sistem</label>
                                <input type="text" name="pengelola_sistem" value="${item.pengelola_sistem || ''}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Roles</label>
                                <input type="number" name="jumlah_roles" value="${item.jumlah_roles || ''}" min="0"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Roles</label>
                                <input type="text" name="nama_roles" value="${item.nama_roles || ''}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Mekanisme Akun</label>
                                <input type="text" name="mekanisme_account" value="${item.mekanisme_account || ''}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Mekanisme Kredensial</label>
                                <input type="text" name="mekanisme_kredensial" value="${item.mekanisme_kredensial || ''}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Fitur Reset Password</label>
                                <select name="fitur_reset_password"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">
                                    <option value="">Pilih</option>
                                    <option value="ada" ${item.fitur_reset_password === 'ada' ? 'selected' : ''}>Ada</option>
                                    <option value="tidak" ${item.fitur_reset_password === 'tidak' ? 'selected' : ''}>Tidak</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">PIC Pengelola</label>
                                <input type="text" name="pic_pengelola" value="${item.pic_pengelola || ''}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan Tambahan</label>
                                <textarea name="keterangan_tambahan" rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">${item.keterangan_tambahan || ''}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Penanggung Jawab -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">Penanggung Jawab</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pejabat Penanggung Jawab <span class="text-red-500">*</span></label>
                                <input type="text" name="pejabat_nama" value="${item.pejabat_nama}" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">NIP <span class="text-red-500">*</span></label>
                                <input type="text" name="pejabat_nip" value="${item.pejabat_nip}" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pangkat/Golongan <span class="text-red-500">*</span></label>
                                <input type="text" name="pejabat_pangkat" value="${item.pejabat_pangkat}" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan <span class="text-red-500">*</span></label>
                                <input type="text" name="pejabat_jabatan" value="${item.pejabat_jabatan}" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#00ADE5] focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            ${item.balasan_admin ? `
                <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <div class="flex items-center mb-2">
                        <div class="w-6 h-6 bg-yellow-200 rounded-full flex items-center justify-center mr-2">
                            <svg class="w-3 h-3 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h4 class="font-medium text-yellow-800">Balasan Admin</h4>
                    </div>
                    <p class="text-sm text-yellow-700">${item.balasan_admin}</p>
                </div>
            ` : ''}
        `;
        
        document.getElementById('editModal').classList.remove('hidden');
    }
        
        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }
        
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
        
        function getStatusBadgeClass(status) {
            switch (status) {
                case 'diproses':
                    return 'bg-yellow-100 text-yellow-800 border-yellow-200';
                case 'revisi':
                    return 'bg-red-100 text-red-800 border-red-200';
                case 'selesai':
                    return 'bg-green-100 text-green-800 border-green-200';
                default:
                    return 'bg-gray-100 text-gray-800 border-gray-200';
            }
        }
        
        function getStatusText(status) {
            switch (status) {
                case 'diproses':
                    return 'Diproses';
                case 'revisi':
                    return 'Revisi';
                case 'selesai':
                    return 'Selesai';
                default:
                    return 'Tidak Diketahui';
            }
        }
        
        // Handle form submission
        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const submitText = submitBtn.querySelector('.submit-text');
            const loadingText = submitBtn.querySelector('.loading-text');
            
            // Show loading state
            submitBtn.disabled = true;
            submitText.classList.add('hidden');
            loadingText.classList.remove('hidden');
            
            // Show loading overlay
            document.getElementById('loadingOverlay').classList.remove('hidden');
            document.getElementById('loadingOverlay').classList.add('flex');
            
            // Create FormData for file upload
            const formData = new FormData(this);
            formData.append('_method', 'POST'); // Laravel method override
            
            // Submit form via fetch
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json', // Penting: minta response JSON
                }
            })
            .then(response => {
                // Check if response is JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new Error('Server tidak mengembalikan JSON response. Kemungkinan terjadi error atau redirect.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Show success message with SweetAlert
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil diupdate',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#00ADE5'
                    }).then((result) => {
                        // Close modal and reload page
                        closeEditModal();
                        location.reload();
                    });
                } else {
                    // Show error message with SweetAlert
                    let errorMessage = data.message || 'Terjadi kesalahan';
                    
                    // If there are validation errors, show them
                    if (data.errors) {
                        const errorList = Object.values(data.errors).flat();
                        errorMessage += ':\n• ' + errorList.join('\n• ');
                    }
                    
                    Swal.fire({
                        title: 'Gagal!',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#EF4444'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan: ' + error.message,
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#EF4444'
                });
            })
            .finally(() => {
                // Hide loading state
                submitBtn.disabled = false;
                submitText.classList.remove('hidden');
                loadingText.classList.add('hidden');
                
                // Hide loading overlay
                document.getElementById('loadingOverlay').classList.add('hidden');
                document.getElementById('loadingOverlay').classList.remove('flex');
            });
        });

        // Fungsi untuk menampilkan error validation secara lebih user-friendly
        function showValidationErrors(errors) {
            let errorHtml = '<div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">';
            errorHtml += '<h4 class="font-semibold text-red-800 mb-2">Terjadi kesalahan validasi:</h4>';
            errorHtml += '<ul class="text-sm text-red-700 space-y-1">';
            
            Object.values(errors).flat().forEach(error => {
                errorHtml += `<li>• ${error}</li>`;
            });
            
            errorHtml += '</ul></div>';
            
            // Insert error at the top of modal content
            const modalContent = document.getElementById('editContent');
            modalContent.insertAdjacentHTML('afterbegin', errorHtml);
            
            // Remove error after 5 seconds
            setTimeout(() => {
                const errorDiv = modalContent.querySelector('.bg-red-50');
                if (errorDiv) {
                    errorDiv.remove();
                }
            }, 5000);
        }
        
        // Close modal when clicking outside
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
        
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
        
        // Handle escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
                closeEditModal();
            }
        });
        
        // Auto-refresh page every 30 seconds to check for status updates
        setInterval(function() {
            // Only refresh if no modal is open
            if (!document.getElementById('detailModal').classList.contains('hidden') || 
                !document.getElementById('editModal').classList.contains('hidden')) {
                return;
            }
            
            // Silent refresh - just update the stats
            fetch(window.location.href, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                // Update only the stats section
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newStats = doc.querySelector('.grid.grid-cols-1.md\\:grid-cols-4');
                const currentStats = document.querySelector('.grid.grid-cols-1.md\\:grid-cols-4');
                
                if (newStats && currentStats) {
                    currentStats.innerHTML = newStats.innerHTML;
                }
            })
            .catch(error => {
                console.log('Auto-refresh failed:', error);
            });
        }, 30000);

        // Fungsi untuk menampilkan error validation secara lebih user-friendly
        function showValidationErrors(errors) {
            let errorHtml = '<div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">';
            errorHtml += '<h4 class="font-semibold text-red-800 mb-2">Terjadi kesalahan validasi:</h4>';
            errorHtml += '<ul class="text-sm text-red-700 space-y-1">';
            
            Object.values(errors).flat().forEach(error => {
                errorHtml += `<li>• ${error}</li>`;
            });
            
            errorHtml += '</ul></div>';
            
            // Insert error at the top of modal content
            const modalContent = document.getElementById('editContent');
            modalContent.insertAdjacentHTML('afterbegin', errorHtml);
            
            // Remove error after 5 seconds
            setTimeout(() => {
                const errorDiv = modalContent.querySelector('.bg-red-50');
                if (errorDiv) {
                    errorDiv.remove();
                }
            }, 5000);
        }
    </script>
</x-app-layout>