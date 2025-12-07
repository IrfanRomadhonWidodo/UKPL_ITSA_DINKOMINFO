<x-app-layout>
<div class="min-h-screen bg-[#E0F7FE] flex items-center justify-center py-12">
    <div class="max-w-2xl w-full mx-4">
        <div class="bg-white rounded-xl shadow-lg p-8 text-center">
            <!-- Success Icon -->
            <div class="mb-6">
                <div class="w-20 h-20 bg-gradient-to-r from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto">
                    <i class="fas fa-check text-white text-3xl"></i>
                </div>
            </div>
            
            <!-- Success Message -->
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Formulir Berhasil Dikirim!</h1>
            <p class="text-gray-600 mb-6">
                Permohonan ITSA Anda telah berhasil dikirim dan sedang dalam proses review. 
                Tim kami akan segera menghubungi Anda untuk langkah selanjutnya.
            </p>
            
            <!-- Status Badge -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <div class="flex items-center justify-center">
                    <div class="w-3 h-3 bg-blue-600 rounded-full mr-2"></div>
                    <span class="text-blue-800 font-medium">Status: Sedang Diproses</span>
                </div>
            </div>
            
            <!-- Information -->
            <div class="text-sm text-gray-500 mb-6">
                <p>Anda akan mendapatkan notifikasi melalui email ketika ada update terbaru mengenai permohonan Anda.</p>
            </div>
            
            <!-- Action Buttons -->
            <div class="space-y-3">
                <a href="{{ route('formulir.index') }}" 
                   class="block w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 text-white rounded-lg hover:from-blue-700 hover:to-cyan-600 transition-all duration-200 text-center">
                    <i class="fas fa-plus mr-2"></i>Buat Permohonan Baru
                </a>
                
                <a href="{{ route('dashboard') }}" 
                   class="block w-full px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200 text-center">
                    <i class="fas fa-home mr-2"></i>Kembali ke Dashboard
                </a>
            </div>
            
            <!-- Contact Information -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-500 mb-2">Butuh bantuan?</p>
                <div class="flex justify-center space-x-4 text-sm">
                    <a href="mailto:dinkominfo@banyumaskab.go.id" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-envelope mr-1"></i>Email Support
                    </a>
                    <a href="tel:+6285747055354" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-phone mr-1"></i>Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FontAwesome for icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</x-app-layout>