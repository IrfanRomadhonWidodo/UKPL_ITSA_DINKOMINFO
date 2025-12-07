<x-app-layout>
<div class="min-h-screen bg-[#E0F7FE] py-8">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Formulir Permohonan ITSA</h1>
            <p class="text-gray-600">Silakan lengkapi formulir berikut dengan data yang akurat</p>
        </div>

        <!-- Progress Bar -->
        <div class="max-w-4xl mx-auto mb-8">
            <div class="flex items-center justify-between mb-4">
                <!-- Step 1 -->
                <div class="flex items-center space-x-4">
                    <div id="step-1-indicator" class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-600 text-white font-semibold">1</div>
                    <div class="hidden sm:block text-sm font-medium text-blue-600">Data Sistem</div>
                </div>
                
                <!-- Progress Bar 1 -->
                <div class="flex-1 mx-4">
                    <div class="h-2 bg-gray-200 rounded-full">
                        <div id="progress-bar-1" class="h-2 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full transition-all duration-300" style="width: 0%"></div>
                    </div>
                </div>
                
                <!-- Step 2 -->
                <div class="flex items-center space-x-4">
                    <div id="step-2-indicator" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-300 text-gray-600 font-semibold">2</div>
                    <div class="hidden sm:block text-sm font-medium text-gray-500">Data Penanggung Jawab</div>
                </div>
                
                <!-- Progress Bar 2 -->
                <div class="flex-1 mx-4">
                    <div class="h-2 bg-gray-200 rounded-full">
                        <div id="progress-bar-2" class="h-2 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full transition-all duration-300" style="width: 0%"></div>
                    </div>
                </div>
                
                <!-- Step 3 -->
                <div class="flex items-center space-x-4">
                    <div id="step-3-indicator" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-300 text-gray-600 font-semibold">3</div>
                    <div class="hidden sm:block text-sm font-medium text-gray-500">Teknis & Keamanan</div>
                </div>
            </div>
        </div>

        <!-- Auto Save Indicator -->
        <div id="auto-save-indicator" class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg hidden">
            <i class="fas fa-check-circle mr-2"></i>Auto saved
        </div>

        <!-- Form Container -->
        <div class="max-w-4xl mx-auto">
            <form id="formulir-form" class="bg-white rounded-xl shadow-lg p-8">
                @csrf
                
                <div id="step-1" class="step-content">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">1</div>
                Data Sistem
            </h2>
            <div class="h-1 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full w-24"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Aplikasi <span class="text-red-600">*</span>
                </label>
                <input type="text" name="nama_aplikasi" id="nama_aplikasi" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Masukkan nama aplikasi">
                <div id="nama_aplikasi_error" class="text-red-500 text-sm mt-1 hidden">Nama aplikasi wajib diisi</div>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Domain Aplikasi <span class="text-red-600">*</span>
                </label>
                <input type="text" name="domain_aplikasi" id="domain_aplikasi" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Contoh: example.com">
                <div id="domain_aplikasi_error" class="text-red-500 text-sm mt-1 hidden">Domain aplikasi wajib diisi</div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">Jenis IP <span class="text-red-600">*</span></label>
                <div class="flex space-x-6">
                    <label class="flex items-center">
                        <input type="radio" name="ip_jenis" value="lokal" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                        <span class="ml-2 text-sm text-gray-700">Lokal</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="ip_jenis" value="public" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                        <span class="ml-2 text-sm text-gray-700">Public</span>
                    </label>
                </div>
                <div id="ip_jenis_error" class="text-red-500 text-sm mt-1 hidden">Jenis IP wajib dipilih</div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">IP Address Server <span class="text-red-600">*</span></label>
                <input type="text" name="ip_address" id="ip_address" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Contoh: 192.168.1.1">
                <div id="ip_address_error" class="text-red-500 text-sm mt-1 hidden">IP Address wajib diisi</div>
            </div>
        </div>
        
        <div class="mt-6 text-xs text-gray-500">
            <span class="text-red-600">*</span> Semua kolom pada bagian ini wajib diisi.
        </div>
    </div>

    <div id="step-2" class="step-content hidden">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">2</div>
                Data Pejabat Penandatangan NDA
            </h2>
            <div class="h-1 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full w-24"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Pejabat <span class="text-red-600">*</span>
                </label>
                <input type="text" name="pejabat_nama" id="pejabat_nama" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Masukkan nama lengkap pejabat">
                <div id="pejabat_nama_error" class="text-red-500 text-sm mt-1 hidden">Nama pejabat wajib diisi</div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    NIP <span class="text-red-600">*</span>
                </label>
                <input type="text" name="pejabat_nip" id="pejabat_nip" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Masukkan NIP">
                <div id="pejabat_nip_error" class="text-red-500 text-sm mt-1 hidden">NIP wajib diisi</div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Pangkat <span class="text-red-600">*</span>
                </label>
                <input type="text" name="pejabat_pangkat" id="pejabat_pangkat" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Masukkan pangkat">
                <div id="pejabat_pangkat_error" class="text-red-500 text-sm mt-1 hidden">Pangkat wajib diisi</div>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Jabatan <span class="text-red-600">*</span>
                </label>
                <input type="text" name="pejabat_jabatan" id="pejabat_jabatan" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Masukkan jabatan">
                <div id="pejabat_jabatan_error" class="text-red-500 text-sm mt-1 hidden">Jabatan wajib diisi</div>
            </div>
        </div>
        
        <div class="mt-6 text-xs text-gray-500">
            <span class="text-red-600">*</span> Semua kolom pada bagian ini wajib diisi.
        </div>
    </div>

    <div id="step-3" class="step-content hidden">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">3</div>
                Teknis & Keamanan
            </h2>
            <div class="h-1 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full w-24"></div>
        </div>

        <div class="space-y-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tujuan Sistem <span class="text-red-600">*</span></label>
                <textarea name="tujuan_sistem" id="tujuan_sistem" rows="4" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Jelaskan tujuan dari sistem yang akan diaudit"></textarea>
                <div id="tujuan_sistem_error" class="text-red-500 text-sm mt-1 hidden">Tujuan sistem wajib diisi</div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Pengguna Sistem <span class="text-red-600">*</span></label>
                <textarea name="pengguna_sistem" id="pengguna_sistem" rows="3" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Jelaskan siapa saja yang akan menggunakan sistem"></textarea>
                <div id="pengguna_sistem_error" class="text-red-500 text-sm mt-1 hidden">Pengguna sistem wajib diisi</div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Hosting <span class="text-red-600">*</span></label>
                <textarea name="hosting" id="hosting" rows="3" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Jelaskan detail hosting (cloud, on-premise, dll)"></textarea>
                <div id="hosting_error" class="text-red-500 text-sm mt-1 hidden">Hosting wajib diisi</div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Framework <span class="text-red-600">*</span></label>
                <input type="text" name="framework" id="framework" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Contoh: Laravel, React, Vue.js">
                <div id="framework_error" class="text-red-500 text-sm mt-1 hidden">Framework wajib diisi</div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Pengelola Sistem <span class="text-red-600">*</span></label>
                <textarea name="pengelola_sistem" id="pengelola_sistem" rows="3" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Jelaskan siapa yang mengelola sistem"></textarea>
                <div id="pengelola_sistem_error" class="text-red-500 text-sm mt-1 hidden">Pengelola sistem wajib diisi</div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Roles <span class="text-red-600">*</span></label>
                    <input type="number" name="jumlah_roles" id="jumlah_roles" min="0" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Masukkan jumlah roles">
                    <div id="jumlah_roles_error" class="text-red-500 text-sm mt-1 hidden">Jumlah roles wajib diisi</div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Roles <span class="text-red-600">*</span></label>
                    <input type="text" name="nama_roles" id="nama_roles" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Contoh: Admin, User, Moderator">
                    <div id="nama_roles_error" class="text-red-500 text-sm mt-1 hidden">Nama roles wajib diisi</div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Mekanisme Account <span class="text-red-600">*</span></label>
                <textarea name="mekanisme_account" id="mekanisme_account" rows="3" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Jelaskan mekanisme pembuatan dan pengelolaan account"></textarea>
                <div id="mekanisme_account_error" class="text-red-500 text-sm mt-1 hidden">Mekanisme account wajib diisi</div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Mekanisme Kredensial <span class="text-red-600">*</span></label>
                <textarea name="mekanisme_kredensial" id="mekanisme_kredensial" rows="3" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Jelaskan mekanisme autentikasi dan otorisasi"></textarea>
                <div id="mekanisme_kredensial_error" class="text-red-500 text-sm mt-1 hidden">Mekanisme kredensial wajib diisi</div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                    Sistem memiliki fitur reset password <span class="text-red-600">*</span>
                </label>
                <div class="flex space-x-6">
                    <label class="flex items-center">
                        <input type="radio" name="fitur_reset_password" value="1" 
                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                        <span class="ml-2 text-sm text-gray-700">Ada</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="fitur_reset_password" value="0" 
                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                        <span class="ml-2 text-sm text-gray-700">Tidak</span>
                    </label>
                </div>
                <div id="fitur_reset_password_error" class="text-red-500 text-sm mt-1 hidden">
                    Pilihan fitur reset password wajib dipilih
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">PIC Pengelola <span class="text-red-600">*</span></label>
                <input type="text" name="pic_pengelola" id="pic_pengelola" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    placeholder="Nama PIC yang bertanggung jawab">
                <div id="pic_pengelola_error" class="text-red-500 text-sm mt-1 hidden">PIC pengelola wajib diisi</div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan Tambahan</label>
                <textarea name="keterangan_tambahan" id="keterangan_tambahan" rows="4" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Informasi tambahan yang diperlukan"></textarea>
            </div>
        </div>
        
        <div class="mt-6 text-xs text-gray-500">
            <span class="text-red-600">*</span> Wajib diisi. Hanya kolom "Keterangan Tambahan" dan "Fitur Reset Password" yang bersifat opsional.
        </div>
    </div>
                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-8 pt-6 border-t border-gray-200">
                    <button type="button" id="prev-btn" class="hidden px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Sebelumnya
                    </button>
                    
                    <div class="flex space-x-4 ml-auto">
                        <button type="button" id="next-btn" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 text-white rounded-lg hover:from-blue-700 hover:to-cyan-600 transition-all duration-200">
                            Selanjutnya<i class="fas fa-arrow-right ml-2"></i>
                        </button>
                        
                        <button type="button" id="preview-btn" class="hidden px-6 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-200">
                            <i class="fas fa-eye mr-2"></i>Preview
                        </button>
                        
                        <button type="button" id="submit-btn" class="hidden px-6 py-3 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-lg hover:from-red-700 hover:to-red-600 transition-all duration-200">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div id="preview-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[80vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-2xl font-bold text-gray-800">Preview Formulir</h3>
                <p class="text-gray-600 mt-1">Periksa kembali data yang akan dikirim</p>
            </div>
            <div id="preview-content" class="p-6">
                <!-- Preview content will be inserted here -->
            </div> 
            
            <!-- Enhanced Verification Section -->
            <div class="px-6 pb-4">
                <div class="bg-gradient-to-br from-gray-50 to-blue-50 p-4 rounded-lg border border-gray-200">
            <label for="verify-checkbox" class="relative flex items-center gap-2 cursor-pointer group mt-1">
                <input type="checkbox" id="verify-checkbox" class="hidden">
                <div id="checkbox-visual" class="w-5 h-5 border-2 border-gray-300 rounded bg-white transition-all duration-200 
                            group-hover:border-red-400 group-hover:shadow-md relative">
                    <svg id="checkbox-check" class="w-3 h-3 text-white absolute top-0.5 left-0.5 opacity-0 transition-opacity duration-200" 
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-sm text-gray-700 select-none">Saya telah memeriksa data dan menyetujuinya</span>
            </label>        
                </div>
            </div>
            
            <div class="p-6 border-t border-gray-200 flex justify-end space-x-4">
                <button type="button" id="close-preview" class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200">
                    Tutup
                </button>
                <button type="button" id="confirm-submit" 
                    class="px-6 py-3 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-lg hover:from-red-700 hover:to-red-600 transition-all duration-200 opacity-50 cursor-not-allowed" 
                    disabled>
                    <i class="fas fa-paper-plane mr-2"></i>Kirim Formulir
                </button>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 3;
    let autoSaveTimeout;
    
    // Elements
    const form = document.getElementById('formulir-form');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const previewBtn = document.getElementById('preview-btn');
    const submitBtn = document.getElementById('submit-btn');
    const progressBar = document.getElementById('progress-bar');
    const autoSaveIndicator = document.getElementById('auto-save-indicator');
    const previewModal = document.getElementById('preview-modal');
    const closePreviewBtn = document.getElementById('close-preview');
    const confirmSubmitBtn = document.getElementById('confirm-submit');
    
    // Load existing data
    loadFormData();
    
    // Auto save functionality
    const formInputs = form.querySelectorAll('input, textarea, select');
    formInputs.forEach(input => {
        input.addEventListener('input', function() {
            clearTimeout(autoSaveTimeout);
            autoSaveTimeout = setTimeout(autoSave, 2000);
        });
    });
    
    // Navigation
    nextBtn.addEventListener('click', function() {
        if (validateCurrentStep()) {
            if (currentStep < totalSteps) {
                currentStep++;
                updateStepDisplay();
            }
        }
    });
    
    prevBtn.addEventListener('click', function() {
        if (currentStep > 1) {
            currentStep--;
            updateStepDisplay();
        }
    });
    
    // Preview and Submit
    previewBtn.addEventListener('click', showPreview);
    submitBtn.addEventListener('click', showPreview);
    closePreviewBtn.addEventListener('click', hidePreview);
    confirmSubmitBtn.addEventListener('click', submitForm);
    
function updateStepDisplay() {
    // Hide all steps
    document.querySelectorAll('.step-content').forEach(step => {
        step.classList.add('hidden');
    });
    
    // Show current step
    document.getElementById(`step-${currentStep}`).classList.remove('hidden');
    
    // Update progress bar untuk setiap section
    // Progress bar 1: full jika step >= 2, 0% jika step = 1
    const progressBar1 = document.getElementById('progress-bar-1');
    if (progressBar1) {
        progressBar1.style.width = currentStep >= 2 ? '100%' : '0%';
    }
    
    // Progress bar 2: full jika step >= 3, 0% jika step < 3
    const progressBar2 = document.getElementById('progress-bar-2');
    if (progressBar2) {
        progressBar2.style.width = currentStep >= 3 ? '100%' : '0%';
    }
    
    // Update step indicators dan teks
    for (let i = 1; i <= totalSteps; i++) {
        const indicator = document.getElementById(`step-${i}-indicator`);
        const stepText = indicator.parentElement.querySelector('.text-sm');
        
        if (i <= currentStep) {
            // Step yang sudah dilalui atau sedang aktif
            indicator.classList.remove('bg-gray-300', 'text-gray-600');
            indicator.classList.add('bg-blue-600', 'text-white');
            
            if (stepText) {
                stepText.classList.remove('text-gray-500');
                stepText.classList.add('text-blue-600');
            }
        } else {
            // Step yang belum dilalui
            indicator.classList.remove('bg-blue-600', 'text-white');
            indicator.classList.add('bg-gray-300', 'text-gray-600');
            
            if (stepText) {
                stepText.classList.remove('text-blue-600');
                stepText.classList.add('text-gray-500');
            }
        }
    }
    
    // Update button visibility
    prevBtn.classList.toggle('hidden', currentStep === 1);
    nextBtn.classList.toggle('hidden', currentStep === totalSteps);
    previewBtn.classList.toggle('hidden', currentStep !== totalSteps);
    submitBtn.classList.toggle('hidden', currentStep !== totalSteps);
}
    
function validateCurrentStep() {
    const currentStepElement = document.getElementById(`step-${currentStep}`);
    let isValid = true;
    
    // Clear previous errors
    currentStepElement.querySelectorAll('.text-red-500').forEach(error => {
        error.classList.add('hidden');
    });
    
    currentStepElement.querySelectorAll('input, textarea').forEach(field => {
        field.classList.remove('border-red-500');
    });
    
    // Validasi field text/textarea yang required
    const requiredFields = currentStepElement.querySelectorAll('input[required]:not([type="radio"]), textarea[required]');
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('border-red-500');
            const errorId = `${field.id}_error`;
            const errorElement = document.getElementById(errorId);
            if (errorElement) {
                errorElement.classList.remove('hidden');
            }
            isValid = false;
        }
    });
    
    // Validasi khusus untuk radio button groups
    const radioGroups = {};
    currentStepElement.querySelectorAll('input[type="radio"][required]').forEach(radio => {
        if (!radioGroups[radio.name]) {
            radioGroups[radio.name] = [];
        }
        radioGroups[radio.name].push(radio);
    });
    
    Object.keys(radioGroups).forEach(groupName => {
        const checkedRadio = currentStepElement.querySelector(`input[name="${groupName}"]:checked`);
        if (!checkedRadio) {
            const errorId = `${groupName}_error`;
            const errorElement = document.getElementById(errorId);
            if (errorElement) {
                errorElement.classList.remove('hidden');
            }
            isValid = false;
        }
    });
    
    return isValid;
}
    
    function autoSave() {
        const formData = new FormData(form);
        
        fetch('/formulir/auto-save', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAutoSaveIndicator();
            }
        })
        .catch(error => {
            console.error('Auto save error:', error);
        });
    }
    
    function showAutoSaveIndicator() {
        autoSaveIndicator.classList.remove('hidden');
        setTimeout(() => {
            autoSaveIndicator.classList.add('hidden');
        }, 2000);
    }
    
    function loadFormData() {
        fetch('/formulir/data')
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data) {
                    const formData = data.data;
                    
                    // Fill form fields
                    Object.keys(formData).forEach(key => {
                        const element = document.getElementById(key);
                        if (element) {
                            if (element.type === 'checkbox') {
                                element.checked = formData[key];
                            } else if (element.type === 'radio') {
                                const radio = document.querySelector(`input[name="${key}"][value="${formData[key]}"]`);
                                if (radio) radio.checked = true;
                            } else {
                                element.value = formData[key] || '';
                            }
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error loading form data:', error);
            });
    }
    
function showPreview() {
    // Validasi semua step sebelum menampilkan preview
    let allStepsValid = true;
    
    for (let step = 1; step <= totalSteps; step++) {
        const tempCurrentStep = currentStep;
        currentStep = step;
        
        if (!validateCurrentStep()) {
            allStepsValid = false;
            currentStep = tempCurrentStep; // Kembali ke step asli
            
            // Pindah ke step yang bermasalah
            currentStep = step;
            updateStepDisplay();
            
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: `Mohon lengkapi semua field yang wajib diisi `,
                confirmButtonText: 'OK',
                confirmButtonColor: '#3b82f6'
            });
            return;
        }
        
        currentStep = tempCurrentStep;
    }
    
    if (!allStepsValid) {
        return;
    }
    
    // Jika semua step valid, tampilkan preview
    const formData = new FormData(form);
    const previewContent = document.getElementById('preview-content');
    
let html = `
    <div class="space-y-4 text-sm text-gray-600">
        <!-- Data Sistem -->
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
            <h4 class="font-medium text-gray-900 mb-3 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Data Sistem
            </h4>
            <div class="space-y-2">
                <div><span class="font-medium text-gray-700">Nama Aplikasi:</span> ${formData.get('nama_aplikasi') || '-'}</div>
                <div><span class="font-medium text-gray-700">Domain:</span> ${formData.get('domain_aplikasi') || '-'}</div>
                <div><span class="font-medium text-gray-700">Jenis IP:</span> ${formData.get('ip_jenis') || '-'}</div>
                <div><span class="font-medium text-gray-700">IP Address:</span> ${formData.get('ip_address') || '-'}</div>
            </div>
        </div>

        <!-- Pejabat Penandatangan -->
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
            <h4 class="font-medium text-gray-900 mb-3 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Pejabat Penandatangan NDA
            </h4>
            <div class="space-y-2">
                <div><span class="font-medium text-gray-700">Nama:</span> ${formData.get('pejabat_nama') || '-'}</div>
                <div><span class="font-medium text-gray-700">NIP:</span> ${formData.get('pejabat_nip') || '-'}</div>
                <div><span class="font-medium text-gray-700">Pangkat:</span> ${formData.get('pejabat_pangkat') || '-'}</div>
                <div><span class="font-medium text-gray-700">Jabatan:</span> ${formData.get('pejabat_jabatan') || '-'}</div>
            </div>
        </div>

        <!-- Teknis & Keamanan -->
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
            <h4 class="font-medium text-gray-900 mb-3 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Teknis & Keamanan
            </h4>
            <div class="space-y-3">
                <div><span class="font-medium text-gray-700">Tujuan Sistem:</span><br>${formData.get('tujuan_sistem') || '-'}</div>
                <div><span class="font-medium text-gray-700">Pengguna Sistem:</span><br>${formData.get('pengguna_sistem') || '-'}</div>
                <div><span class="font-medium text-gray-700">Hosting:</span><br>${formData.get('hosting') || '-'}</div>
                <div class="space-y-2">
                    <div><span class="font-medium text-gray-700">Framework:</span> ${formData.get('framework') || '-'}</div>
                    <div>
                        <span class="font-medium text-gray-700">Roles:</span>
                        ${formData.get('jumlah_roles') || '0'} peran
                        (${formData.get('nama_roles') || '-'})
                    </div>
                </div>
                <div><span class="font-medium text-gray-700">Pengelola Sistem:</span><br>${formData.get('pengelola_sistem') || '-'}</div>
                <div><span class="font-medium text-gray-700">Mekanisme Account:</span><br>${formData.get('mekanisme_account') || '-'}</div>
                <div><span class="font-medium text-gray-700">Mekanisme Kredensial:</span><br>${formData.get('mekanisme_kredensial') || '-'}</div>
                <div><span class="font-medium text-gray-700">Fitur Reset Password:</span> ${formData.get('fitur_reset_password') === '1' ? 'Ada' : 'Tidak'}</div>
                <div><span class="font-medium text-gray-700">PIC Pengelola:</span> ${formData.get('pic_pengelola') || '-'}</div>
                <div><span class="font-medium text-gray-700">Keterangan Tambahan:</span><br>${formData.get('keterangan_tambahan') || 'Tidak ada'}</div>
            </div>
        </div>
    </div>
`;

    
    previewContent.innerHTML = html;
    previewModal.classList.remove('hidden');
}
    
    function hidePreview() {
        previewModal.classList.add('hidden');
    }
    
function submitForm() {
    const formData = new FormData(form);
    
    fetch('/formulir/submit', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Formulir berhasil dikirim! Status: ' + data.message,
                confirmButtonText: 'OK',
                confirmButtonColor: '#22c55e'
            }).then(() => {
                hidePreview();
                // Optionally redirect to success page
                window.location.href = '/formulir/success';
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: 'Terjadi kesalahan: ' + data.message,
                confirmButtonText: 'OK',
                confirmButtonColor: '#ef4444'
            });
            if (data.errors) {
                console.error('Validation errors:', data.errors);
            }
        }
    })
    .catch(error => {
        console.error('Submit error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan!',
            text: 'Terjadi kesalahan saat mengirim formulir',
            confirmButtonText: 'OK',
            confirmButtonColor: '#ef4444'
        });
    });
}
    
    // Initialize display
    updateStepDisplay();

// === Checkbox verifikasi kirim formulir ===
const checkbox = document.getElementById("verify-checkbox");
const submitConfirmBtn = document.getElementById("confirm-submit");
const checkboxVisual = document.getElementById("checkbox-visual");
const checkboxCheck = document.getElementById("checkbox-check");

if (checkbox && submitConfirmBtn && checkboxVisual && checkboxCheck) {
    checkbox.addEventListener("change", function () {
        if (checkbox.checked) {
            // Update visual checkbox
            checkboxVisual.classList.add("bg-gradient-to-r", "from-red-600", "to-red-500", "border-red-500");
            checkboxVisual.classList.remove("bg-white", "border-gray-300");
            checkboxCheck.classList.remove("opacity-0");
            checkboxCheck.classList.add("opacity-100");
            
            // Enable submit button
            submitConfirmBtn.disabled = false;
            submitConfirmBtn.classList.remove("opacity-50", "cursor-not-allowed");
        } else {
            // Reset visual checkbox
            checkboxVisual.classList.remove("bg-gradient-to-r", "from-red-600", "to-red-500", "border-red-500");
            checkboxVisual.classList.add("bg-white", "border-gray-300");
            checkboxCheck.classList.add("opacity-0");
            checkboxCheck.classList.remove("opacity-100");
            
            // Disable submit button
            submitConfirmBtn.disabled = true;
            submitConfirmBtn.classList.add("opacity-50", "cursor-not-allowed");
        }
    });

    // Reset saat modal ditutup
    const closeBtn = document.getElementById("close-preview");
    if (closeBtn) {
        closeBtn.addEventListener("click", () => {
            checkbox.checked = false;
            
            // Reset visual checkbox
            checkboxVisual.classList.remove("bg-gradient-to-r", "from-red-600", "to-red-500", "border-red-500");
            checkboxVisual.classList.add("bg-white", "border-gray-300");
            checkboxCheck.classList.add("opacity-0");
            checkboxCheck.classList.remove("opacity-100");
            
            // Disable submit button
            submitConfirmBtn.disabled = true;
            submitConfirmBtn.classList.add("opacity-50", "cursor-not-allowed");
        });
    }
}
});
</script>

<!-- FontAwesome for icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

</x-app-layout>