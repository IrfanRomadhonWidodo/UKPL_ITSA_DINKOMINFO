<x-app-admin>
    <div id="modalBackdrop" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-40 hidden"></div>

    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Manajemen Hasil ITSA</h2>
            <p class="text-gray-600 mt-1">Kelola hasil assessment keamanan aplikasi</p>
        </div>
        <div class="flex space-x-3">
            <button onclick="openModal('createHasilModal')"
                class="flex items-center px-4 py-2 bg-gradient-to-r from-[#EDBC19] to-[#8F181A] text-white rounded-md hover:opacity-90 transition shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Buat Hasil Baru
            </button>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <span class="text-sm font-medium text-gray-700">Total: <span class="text-orange-400">{{ $hasil->total() }}</span> hasil</span>
                    </div>
                </div>
                <form action="{{ route('admin.hasil.index') }}" method="GET" class="flex items-center space-x-3">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari hasil..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-64"
                            value="{{ request('search') }}">
                        <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Cari
                    </button>
                    @if(request('search'))
                    <a href="{{ route('admin.hasil.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
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
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Foto</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Aplikasi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Pengaju</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tautan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($hasil as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                           <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/default-user.png') }}" alt="Foto" class="w-10 h-10 rounded-full object-cover">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $item->formulir->nama_aplikasi }}</div>
                            <div class="text-sm text-gray-500">{{ $item->formulir->domain_aplikasi }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $item->formulir->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $item->formulir->user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->tautan)
                                <a href="{{ $item->tautan }}" target="_blank" class="text-blue-600 hover:text-blue-900 text-sm">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    Lihat Tautan
                                </a>
                            @else
                                <span class="text-gray-400 text-sm">Tidak ada tautan</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $item->created_at->format('d M Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $item->created_at->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-3">
                                <button onclick="openModal('viewHasilModal{{ $item->id }}')" class="text-blue-600 hover:text-blue-900 flex items-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <button onclick="openModal('editHasilModal{{ $item->id }}')" class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('admin.hasil.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteHasil({{ $item->id }})" class="text-red-600 hover:text-red-900 flex items-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal View Hasil -->
                    <div id="viewHasilModal{{ $item->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
                            <!-- Modal Header -->
                            <div class="sticky top-0 bg-gradient-to-r from-[#EDBC19] to-[#8F181A] px-6 py-4 rounded-t-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-xl font-bold text-white">Detail Hasil ITSA</h3>
                                        <p class="text-white/80 text-sm mt-1">{{ $item->formulir->nama_aplikasi }}</p>
                                    </div>
                                    <button onclick="closeModal('viewHasilModal{{ $item->id }}')" class="text-white/80 hover:text-white transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Modal Content -->
                            <div class="px-6 py-6">
                                <div class="space-y-6">
                                    
                                    <!-- Section 1: Informasi Aplikasi -->
                                    <div class="bg-blue-50 rounded-lg p-6">
                                        <div class="flex items-center mb-4">
                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            </div>
                                            <h4 class="text-lg font-semibold text-gray-900">Informasi Aplikasi</h4>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="space-y-2">
                                                <div class="flex flex-col">
                                                    <span class="font-medium text-gray-600 text-sm">Nama Aplikasi</span>
                                                    <span class="text-gray-900 font-semibold">{{ $item->formulir->nama_aplikasi }}</span>
                                                </div>
                                            </div>
                                            <div class="space-y-2">
                                                <div class="flex flex-col">
                                                    <span class="font-medium text-gray-600 text-sm">Domain</span>
                                                    <span class="text-gray-900">{{ $item->formulir->domain_aplikasi }}</span>
                                                </div>
                                            </div>
                                            <div class="space-y-2">
                                                <div class="flex flex-col">
                                                    <span class="font-medium text-gray-600 text-sm">Pengaju</span>
                                                    <span class="text-gray-900">{{ $item->formulir->user->name }}</span>
                                                </div>
                                            </div>
                                            <div class="space-y-2">
                                                <div class="flex flex-col">
                                                    <span class="font-medium text-gray-600 text-sm">Email Pengaju</span>
                                                    <span class="text-gray-900">{{ $item->formulir->user->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 2: Hasil Assessment -->
                                    <div class="bg-green-50 rounded-lg p-6">
                                        <div class="flex items-center mb-4">
                                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <h4 class="text-lg font-semibold text-gray-900">Hasil Assessment</h4>
                                        </div>
                                        <div class="space-y-4">
                                            @if($item->image)
                                            <div class="space-y-2">
                                                <span class="font-medium text-gray-600 text-sm">Gambar Hasil</span>
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $item->image) }}" alt="Hasil Assessment" class="max-w-full h-auto rounded-lg shadow-md">
                                                </div>
                                            </div>
                                            @endif
                                            <div class="space-y-2">
                                                <span class="font-medium text-gray-600 text-sm">Deskripsi</span>
                                                <div class="bg-white p-4 rounded-lg border">
                                                    <p class="text-gray-900 whitespace-pre-line">{{ $item->deskripsi }}</p>
                                                </div>
                                            </div>
                                            @if($item->tautan)
                                            <div class="space-y-2">
                                                <span class="font-medium text-gray-600 text-sm">Tautan</span>
                                                <a href="{{ $item->tautan }}" target="_blank" class="text-blue-600 hover:text-blue-900 break-all">
                                                    {{ $item->tautan }}
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Section 3: Informasi Waktu -->
                                    <div class="bg-gray-50 rounded-lg p-6">
                                        <div class="flex items-center mb-4">
                                            <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <h4 class="text-lg font-semibold text-gray-900">Informasi Waktu</h4>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="space-y-2">
                                                <div class="flex flex-col">
                                                    <span class="font-medium text-gray-600 text-sm">Tanggal Dibuat</span>
                                                    <span class="text-gray-900">{{ $item->created_at->format('d M Y, H:i') }}</span>
                                                </div>
                                            </div>
                                            <div class="space-y-2">
                                                <div class="flex flex-col">
                                                    <span class="font-medium text-gray-600 text-sm">Terakhir Diperbarui</span>
                                                    <span class="text-gray-900">{{ $item->updated_at->format('d M Y, H:i') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Modal Footer -->
                            <div class="sticky bottom-0 bg-white px-6 py-4 border-t border-gray-200 rounded-b-lg">
                                <div class="flex justify-end space-x-3">
                                    <button onclick="closeModal('viewHasilModal{{ $item->id }}')" 
                                            class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit Hasil -->
                    <div id="editHasilModal{{ $item->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
                            <div class="sticky top-0 bg-white px-6 py-4 border-b border-gray-200 rounded-t-lg">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-900">Edit Hasil</h3>
                                    <button onclick="closeModal('editHasilModal{{ $item->id }}')" class="text-gray-400 hover:text-gray-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <form action="{{ route('admin.hasil.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="px-6 py-4">
                                    <div class="space-y-4">
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <span class="text-sm font-medium text-gray-700">Aplikasi: </span>
                                            <span class="text-gray-900">{{ $item->formulir->nama_aplikasi }}</span>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Gambar Hasil</label>
                                            @if($item->image)
                                            <div class="mt-2 mb-3">
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="Current image" class="max-w-xs h-auto rounded-lg">
                                                <p class="text-sm text-gray-500 mt-1">Gambar saat ini</p>
                                            </div>
                                            @endif
                                            <input type="file" name="image" accept="image/*"
                                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Deskripsi *</label>
                                            <textarea name="deskripsi" rows="6" required
                                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $item->deskripsi }}</textarea>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Tautan</label>
                                            <input type="url" name="tautan" value="{{ $item->tautan }}"
                                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                                    </div>
                                </div>
                                <div class="sticky bottom-0 bg-white px-6 py-4 border-t border-gray-200 flex space-x-3 rounded-b-lg">
                                    <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-[#EDBC19] to-[#8F181A] text-white rounded-md hover:opacity-90 transition">
                                        Simpan Perubahan
                                    </button>
                                    <button type="button" onclick="closeModal('editHasilModal{{ $item->id }}')" class="flex-1 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                            Belum ada hasil yang dibuat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $hasil->links() }}
        </div>
    </div>

    <!-- Modal Create Hasil -->
    <div id="createHasilModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 bg-white px-6 py-4 border-b border-gray-200 rounded-t-lg">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Buat Hasil Baru</h3>
                    <button onclick="closeModal('createHasilModal')" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <form action="{{ route('admin.hasil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="px-6 py-4">
                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Display session messages -->
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif --}}

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pilih Formulir *</label>
                            <select name="formulir_id" required
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih formulir...</option>
                                @foreach($formulirSelesai as $form)
                                <option value="{{ $form->id }}" {{ old('formulir_id') == $form->id ? 'selected' : '' }}>
                                    {{ $form->nama_aplikasi }} - {{ $form->user->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('formulir_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Gambar Hasil</label>
                            <input type="file" name="image" accept="image/*"
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Deskripsi *</label>
                            <textarea name="deskripsi" rows="6" required
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan deskripsi hasil assessment...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tautan</label>
                            <input type="url" name="tautan" value="{{ old('tautan') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="https://...">
                            @error('tautan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="sticky bottom-0 bg-white px-6 py-4 border-t border-gray-200 flex space-x-3 rounded-b-lg">
                    <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-[#EDBC19] to-[#8F181A] text-white rounded-md hover:opacity-90 transition">
                        Simpan Hasil
                    </button>
                    <button type="button" onclick="closeModal('createHasilModal')" class="flex-1 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
<script>
    // Fungsi untuk membuka modal
    function openModal(modalId) {
        document.getElementById('modalBackdrop').classList.remove('hidden');
        document.getElementById(modalId).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    // Fungsi untuk menutup modal
    function closeModal(modalId) {
        document.getElementById('modalBackdrop').classList.add('hidden');
        document.getElementById(modalId).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Menutup modal saat klik di luar (backdrop)
    document.getElementById('modalBackdrop').addEventListener('click', function () {
        document.querySelectorAll('[id$="Modal"]').forEach(modal => {
            modal.classList.add('hidden');
        });
        this.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });

    // Konfirmasi penghapusan dengan SweetAlert
    function deleteHasil(id) {
        // Tampilkan backdrop blur manual
        document.getElementById('modalBackdrop').classList.remove('hidden');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8F181A',
            cancelButtonColor: '#9ca3af',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            backdrop: false // Nonaktifkan backdrop SweetAlert karena kita pakai sendiri
        }).then((result) => {
            document.getElementById('modalBackdrop').classList.add('hidden');

            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Auto-hide alert biasa setelah 5 detik
    document.addEventListener('DOMContentLoaded', function () {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }, 5000);
        });
    });

    // SweetAlert untuk notifikasi sukses dari session (Laravel)
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>

</x-app-admin>
