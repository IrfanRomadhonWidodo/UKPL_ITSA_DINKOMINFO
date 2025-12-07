<x-app-admin>
    <div id="modalBackdrop" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-40 hidden"></div>

    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Manajemen Feedback</h2>
            <p class="text-gray-600 mt-1">Kelola feedback dari pengguna dan berikan balasan</p>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <span class="text-sm font-medium text-gray-700">Total: <span class="text-orange-400">{{ $feedbacks->total() }}</span> feedback</span>
                    </div>
                </div>
                <form action="{{ route('admin.feedbacks.index') }}" method="GET" class="flex items-center space-x-3">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari feedback..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-64"
                            value="{{ request('search') }}">
                        <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <select name="status" class="pl-3 pr-8 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Status</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Cari
                    </button>
                    @if(request('search') || request('status'))
                    <a href="{{ route('admin.feedbacks.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
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
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Subjek</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Pesan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Balasan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($feedbacks as $feedback)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $feedback->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $feedback->user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $feedback->subjek_label }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ Str::limit($feedback->pesan, 50) }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($feedback->balasan_admin)
                                <div class="text-sm text-gray-900">{{ Str::limit($feedback->balasan_admin, 50) }}</div>
                            @else
                                <span class="text-sm text-gray-400 italic">Belum ada balasan</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'menunggu' => 'bg-yellow-100 text-yellow-800',
                                    'diproses' => 'bg-blue-100 text-blue-800',
                                    'selesai' => 'bg-green-100 text-green-800'
                                ];
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$feedback->status] }}">
                                {{ ucfirst($feedback->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $feedback->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-3">
                                <button onclick="openModal('viewFeedbackModal{{ $feedback->id }}')" class="text-blue-600 hover:text-blue-900 flex items-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <button onclick="openModal('replyFeedbackModal{{ $feedback->id }}')" class="text-green-600 hover:text-green-900 flex items-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                    </svg>
                                </button>
                                <form id="delete-form-{{ $feedback->id }}" action="{{ route('admin.feedbacks.destroy', $feedback->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteFeedback({{ $feedback->id }})" class="text-red-600 hover:text-red-900 flex items-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

<!-- Modal View Feedback - Improved Version -->
<div id="viewFeedbackModal{{ $feedback->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-gradient-to-r from-[#EDBC19] to-[#8F181A] px-6 py-4 rounded-t-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-white">Detail Feedback</h3>
                    <p class="text-white/80 text-sm mt-1">{{ $feedback->subjek_label }}</p>
                </div>
                <button onclick="closeModal('viewFeedbackModal{{ $feedback->id }}')" class="text-white/80 hover:text-white transition-colors">
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
                            'menunggu' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                            'diproses' => 'bg-blue-100 text-blue-800 border-blue-200',
                            'selesai' => 'bg-green-100 text-green-800 border-green-200'
                        ];
                    @endphp
                    <span class="px-4 py-2 text-sm font-semibold rounded-full border {{ $statusColors[$feedback->status] ?? 'bg-gray-100 text-gray-800 border-gray-200' }}">
                        {{ ucfirst($feedback->status) }}
                    </span>
                </div>
                <div class="text-sm text-gray-500">
                    <span class="font-medium">Dibuat:</span> {{ $feedback->created_at->format('d M Y, H:i') }}
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
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">Nama</span>
                                <span class="text-gray-900 font-semibold">{{ $feedback->user->name }}</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-600 text-sm">Email</span>
                                <span class="text-gray-900">{{ $feedback->user->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Detail Feedback -->
                <div class="bg-blue-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">Detail Feedback</h4>
                    </div>
                    <div class="space-y-4">
                        <div class="flex flex-col">
                            <span class="font-medium text-gray-600 text-sm">Subjek</span>
                            <span class="text-gray-900 font-semibold">{{ $feedback->subjek_label }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-medium text-gray-600 text-sm">Pesan</span>
                            <div class="bg-white p-4 rounded-lg border border-blue-200 mt-2">
                                <p class="text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $feedback->pesan }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Balasan Admin -->
                @if($feedback->balasan_admin)
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">Balasan Admin</h4>
                    </div>
                    <div class="bg-white p-4 rounded-lg border">
                        <p class="text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $feedback->balasan_admin }}</p>
                    </div>
                </div>
                @endif

            </div>
        </div>

        <!-- Modal Footer -->
        <div class="sticky bottom-0 bg-white px-6 py-4 border-t border-gray-200 rounded-b-lg">
            <div class="flex justify-end space-x-3">
                <button onclick="closeModal('viewFeedbackModal{{ $feedback->id }}')" 
                        class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
                    <!-- Modal Reply Feedback -->
                    <div id="replyFeedbackModal{{ $feedback->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
                            <div class="sticky top-0 bg-white px-6 py-4 border-b border-gray-200 rounded-t-lg">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-900">Balas Feedback</h3>
                                    <button onclick="closeModal('replyFeedbackModal{{ $feedback->id }}')" class="text-gray-400 hover:text-gray-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <form action="{{ route('admin.feedbacks.update', $feedback->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="px-6 py-4">
                                    <div class="space-y-4">
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <h4 class="font-medium text-gray-900 mb-2">Feedback dari {{ $feedback->user->name }}</h4>
                                            <p class="text-sm text-gray-600 mb-2"><strong>Subjek:</strong> {{ $feedback->subjek_label }}</p>
                                            <p class="text-sm text-gray-600 whitespace-pre-wrap">{{ $feedback->pesan }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Balasan Admin</label>
                                            <textarea name="balasan_admin" rows="4" required
                                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                placeholder="Tulis balasan Anda di sini...">{{ $feedback->balasan_admin }}</textarea>
                                            <p class="mt-2 text-sm text-gray-500">Setelah mengirim balasan, status akan otomatis berubah menjadi "Selesai"</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="sticky bottom-0 bg-white px-6 py-4 border-t border-gray-200 flex space-x-3 rounded-b-lg">
                                    <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-[#EDBC19] to-[#8F181A] text-white rounded-md hover:opacity-90 transition">
                                        Kirim Balasan
                                    </button>
                                    <button type="button" onclick="closeModal('replyFeedbackModal{{ $feedback->id }}')" class="flex-1 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                            Tidak ada feedback yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $feedbacks->links() }}
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
        function deleteFeedback(id) {
            // Show backdrop with blur
            document.getElementById('modalBackdrop').classList.remove('hidden');
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Feedback yang dihapus tidak dapat dikembalikan!",
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