<x-app-layout>
<div class="py-12 bg-[#E0F7FE]">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-xl p-6">
            
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Notifikasi</h2>
                <div class="flex gap-2">
                    <button id="deleteSelectedBtn" onclick="deleteSelectedNotifications()" style="display: none;"
                        class="flex items-center gap-2 bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded-lg hover:opacity-90 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1H9a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        <span id="deleteSelectedText">Hapus Terpilih (0)</span>
                    </button>
                    
                    @if($unreadCount > 0)
                    <button onclick="markAllAsRead()"
                        class="flex items-center gap-2 bg-gradient-to-r from-[#00ADE5] to-[#016DAE] text-white px-4 py-2 rounded-lg hover:opacity-90 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                             d="M5 13l4 4L19 7"/></svg>
                        Tandai Semua Dibaca
                    </button>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-2 mb-4">
                <input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll()" 
                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                <label for="selectAllCheckbox" class="text-sm text-gray-600">Pilih Semua</label>
                <span class="text-sm text-gray-500 ml-4">{{ $unreadCount }} notifikasi belum dibaca</span>
            </div>

            <div class="space-y-4">
                @forelse($notifikasi as $item)
                <div class="relative group">
                    <div class="flex items-start gap-3">
                        <input type="checkbox" class="notification-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 mt-4" 
                               data-id="{{ $item->id }}" onchange="updateDeleteButton()">
                        
                        <a href="{{ route('notifikasi.show', $item->id) }}" 
                           class="flex-1 block p-4 rounded-xl border transition-all duration-200
                                  {{ $item->is_read ? 'bg-white border-gray-200' : 'bg-blue-50 border-blue-200' }}
                                  hover:shadow hover:bg-blue-100">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <h3 class="font-semibold text-gray-900 text-base">
                                            {{ $item->judul }}
                                        </h3>
                                        @if(!$item->is_read)
                                            <span class="text-xs bg-blue-100 text-blue-800 font-medium px-2 py-0.5 rounded-full">
                                                Baru
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-700">
                                        {{ Str::limit($item->pesan, 100) }}
                                    </p>
                                </div>
                                <span class="text-xs text-gray-400 mt-1 whitespace-nowrap">
                                    {{ $item->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                <div class="text-center py-10 text-gray-500">
                    <svg class="w-14 h-14 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <style>
                            .bell-animation {
                                animation: ring 2s ease-in-out infinite;
                                transform-origin: 50% 4px;
                            }
                            @keyframes ring {
                                0%, 50%, 100% { transform: rotate(0deg); }
                                10%, 30% { transform: rotate(-10deg); }
                                20%, 40% { transform: rotate(10deg); }
                            }
                        </style>
                        <g class="bell-animation">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M13.73 21a2 2 0 0 1-3.46 0"/>
                        </g>
                    </svg>
                    Tidak ada notifikasi untuk ditampilkan.
                </div>
                @endforelse
            </div>

            @if($notifikasi->hasPages())
            <div class="mt-6">
                {{ $notifikasi->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function markAllAsRead() {
        fetch('/notifikasi/mark-all-read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Semua notifikasi telah ditandai dibaca.',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => location.reload());
            }
        });
    }

    function updateDeleteButton() {
        const checkboxes = document.querySelectorAll('.notification-checkbox:checked');
        const deleteBtn = document.getElementById('deleteSelectedBtn');
        const deleteText = document.getElementById('deleteSelectedText');
        
        if (checkboxes.length > 0) {
            deleteBtn.style.display = 'flex';
            deleteText.textContent = `Hapus Terpilih (${checkboxes.length})`;
        } else {
            deleteBtn.style.display = 'none';
        }
        
        const allCheckboxes = document.querySelectorAll('.notification-checkbox');
        const selectAllCheckbox = document.getElementById('selectAllCheckbox');
        
        if (checkboxes.length === allCheckboxes.length) {
            selectAllCheckbox.checked = true;
            selectAllCheckbox.indeterminate = false;
        } else if (checkboxes.length > 0) {
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = true;
        } else {
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = false;
        }
    }

    function toggleSelectAll() {
        const selectAllCheckbox = document.getElementById('selectAllCheckbox');
        const allCheckboxes = document.querySelectorAll('.notification-checkbox');
        
        allCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
        
        updateDeleteButton();
    }

    function deleteSelectedNotifications() {
        const selectedCheckboxes = document.querySelectorAll('.notification-checkbox:checked');
        const selectedIds = Array.from(selectedCheckboxes).map(cb => cb.getAttribute('data-id'));

        if (selectedIds.length === 0) {
            Swal.fire({
                icon: 'info',
                title: 'Tidak ada yang dipilih',
                text: 'Pilih notifikasi yang ingin dihapus terlebih dahulu.'
            });
            return;
        }

        Swal.fire({
            title: `Yakin ingin menghapus ${selectedIds.length} notifikasi yang dipilih?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/notifikasi/delete-multiple', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ ids: selectedIds })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Notifikasi berhasil dihapus.',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    } else {
                        Swal.fire('Gagal', 'Gagal menghapus notifikasi.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Terjadi kesalahan saat menghapus notifikasi.', 'error');
                });
            }
        });
    }
</script>
@endpush
</x-app-layout>