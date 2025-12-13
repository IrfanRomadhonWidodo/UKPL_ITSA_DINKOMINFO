<?php

namespace Database\Seeders;

use App\Models\Hasil;
use App\Models\Formulir;
use Illuminate\Database\Seeder;

class HasilSeeder extends Seeder
{
    public function run(): void
    {
        // Get formulir yang sudah disetujui atau beberapa formulir untuk testing
        $formulirs = Formulir::take(5)->get();

        if ($formulirs->isEmpty()) {
            $this->command->warn('Tidak ada formulir, hasil tidak dapat dibuat.');
            return;
        }

        $hasilData = [
            [
                'deskripsi' => 'Hasil ITSA untuk sistem SIMPEG menunjukkan tingkat keamanan yang baik dengan skor 85/100.',
                'tautan' => 'https://example.com/hasil/simpeg',
            ],
            [
                'deskripsi' => 'Hasil ITSA untuk sistem E-Office menunjukkan beberapa kerentanan minor yang perlu diperbaiki.',
                'tautan' => 'https://example.com/hasil/eoffice',
            ],
            [
                'deskripsi' => 'Hasil ITSA untuk LPSE menunjukkan sistem memenuhi standar keamanan nasional.',
                'tautan' => 'https://example.com/hasil/lpse',
            ],
            [
                'deskripsi' => 'Hasil ITSA untuk BKD menunjukkan perlunya peningkatan pada autentikasi pengguna.',
                'tautan' => 'https://example.com/hasil/bkd',
            ],
            [
                'deskripsi' => 'Hasil ITSA untuk BAPENDA menunjukkan sistem telah memenuhi standar keamanan tinggi.',
                'tautan' => 'https://example.com/hasil/bapenda',
            ],
        ];

        foreach ($formulirs as $index => $formulir) {
            // Skip jika sudah ada hasil untuk formulir ini atau jika ini adalah formulir untuk testing create
            if (Hasil::where('formulir_id', $formulir->id)->exists() || $formulir->nama_aplikasi === 'Aplikasi Siap Hasil') {
                continue;
            }

            $data = $hasilData[$index] ?? $hasilData[0];

            Hasil::create([
                'formulir_id' => $formulir->id,
                'image' => null, // Bisa ditambahkan path gambar jika ada
                'deskripsi' => $data['deskripsi'],
                'tautan' => $data['tautan'],
            ]);

            // Update status formulir menjadi selesai
            $formulir->update(['status' => 'selesai']);
        }

        $this->command->info('Seeder Hasil ITSA berhasil dijalankan.');
    }
}
