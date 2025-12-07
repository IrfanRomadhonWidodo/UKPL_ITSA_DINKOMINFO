<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Irfan',
            'email' => 'irfanromadhonwidodo86@gmail.com',
            'password' => Hash::make('irfan123'),
            'role' => 'admin',
            'status' => 'disetujui',
        ]);

        User::create([
            'name' => 'Bina',
            'email' => 'essaybina31@gmail.com',
            'password' => Hash::make('bina123'),
            'role' => 'admin',
            'status' => 'disetujui',
        ]);

        // User disetujui (5)
        $approved = [
            'Seta Pratama',
            'Agung Wijaya',
            'Rina Sari',
            'Fadli Ramadhan',
            'Dewi Pertiwi',
        ];
        foreach ($approved as $i => $name) {
            User::create([
                'name' => $name,
                'email' => 'user_approved' . $i . '@example.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'status' => 'disetujui',
            ]);
        }

        // User diproses (3)
        $processing = [
            'Seta Nugraha',
            'Agung Saputra',
            'Linda Ayu',
        ];
        foreach ($processing as $i => $name) {
            User::create([
                'name' => $name,
                'email' => 'user_processing' . $i . '@example.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'status' => 'diproses',
            ]);
        }

        // User ditolak (2)
        $rejected = [
            'Budi Santoso',
            'Citra Melati',
        ];
        foreach ($rejected as $i => $name) {
            User::create([
                'name' => $name,
                'email' => 'user_rejected' . $i . '@example.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'status' => 'ditolak',
            ]);
        }

    // Panggil seeder lain jika ada
    $this->call([
        FormulirSeeder::class,
        FeedbackSeeder::class, // tambahkan ini
    ]);

    }
}
