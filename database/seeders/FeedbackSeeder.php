<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    public function run(): void
    {
        $approvedUsers = User::where('status', 'disetujui')->get();

        if ($approvedUsers->isEmpty()) {
            $this->command->warn('Tidak ada user dengan status "disetujui", feedback tidak dapat dibuat.');
            return;
        }

        $subjekList = [
            'masalah_teknis',
            'keluhan_layanan',
            'saran_pengembangan',
            'pertanyaan_informasi',
        ];

        $pesanList = [
            'Saya mengalami kendala saat mengakses halaman utama.',
            'Layanan yang diberikan cukup baik, tetapi perlu peningkatan di bagian keamanan.',
            'Saya menyarankan agar fitur pencarian lebih dioptimalkan.',
            'Mohon informasi lebih lanjut mengenai jadwal pelayanan.',
            'Tampilan antarmuka cukup membingungkan bagi pengguna baru.',
            'Apakah tersedia fitur untuk mencetak laporan secara langsung?',
            'Mohon periksa kembali data saya, ada ketidaksesuaian.',
            'Apakah ada panduan lengkap untuk penggunaan sistem ini?',
            'Saya merasa sistem ini cukup lambat saat jam sibuk.',
            'Sangat membantu, tetapi perlu perbaikan dalam hal responsivitas.',
        ];

        // 45 feedback dari user disetujui
        for ($i = 0; $i < 45; $i++) {
            $user = $approvedUsers->random();

            Feedback::create([
                'user_id' => $user->id,
                'subjek' => $subjekList[array_rand($subjekList)],
                'pesan' => $pesanList[array_rand($pesanList)],
                'balasan_admin' => null,
                'status' => 'diproses',
            ]);
        }

        // 5 feedback dari admin bernama "Irfan"
        $adminIrfan = User::where('name', 'Irfan')->first();
        if (!$adminIrfan) {
            $this->command->warn('User dengan nama "Irfan" tidak ditemukan.');
            return;
        }

        for ($i = 0; $i < 5; $i++) {
            Feedback::create([
                'user_id' => $adminIrfan->id,
                'subjek' => $subjekList[array_rand($subjekList)],
                'pesan' => 'Feedback dari admin untuk pengujian sistem #' . ($i + 1),
                'balasan_admin' => null,
                'status' => 'diproses',
            ]);
        }

        $this->command->info('Seeder Feedback berhasil dijalankan.');
    }
}
