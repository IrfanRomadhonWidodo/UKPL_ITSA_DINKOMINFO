<?php

namespace Database\Seeders;

use App\Models\Notifikasi;
use App\Models\User;
use App\Models\Feedback;
use App\Models\Formulir;
use Illuminate\Database\Seeder;

class NotifikasiSeeder extends Seeder
{
    public function run(): void
    {
        $approvedUsers = User::where('status', 'disetujui')->where('role', 'user')->get();

        if ($approvedUsers->isEmpty()) {
            $this->command->warn('Tidak ada user dengan status "disetujui", notifikasi tidak dapat dibuat.');
            return;
        }

        // Get some feedbacks and formulirs for notification references
        $feedbacks = Feedback::all();
        $formulirs = Formulir::all();

        // Notifikasi tipe: feedback_reply
        foreach ($approvedUsers->take(3) as $user) {
            $feedback = $feedbacks->where('user_id', $user->id)->first();

            Notifikasi::create([
                'user_id' => $user->id,
                'judul' => 'Balasan Feedback',
                'pesan' => 'Admin telah membalas feedback Anda mengenai layanan sistem.',
                'type' => 'feedback_reply',
                'feedback_id' => $feedback?->id,
                'formulir_id' => null,
                'is_read' => false,
                'read_at' => null,
            ]);
        }

        // Notifikasi tipe: formulir_status (diproses)
        foreach ($approvedUsers->take(3) as $user) {
            $formulir = $formulirs->where('user_id', $user->id)->first() ?? $formulirs->first();

            Notifikasi::create([
                'user_id' => $user->id,
                'judul' => 'Status Formulir Diperbarui',
                'pesan' => 'Formulir pengajuan ITSA Anda sedang dalam proses verifikasi.',
                'type' => 'formulir_status',
                'feedback_id' => null,
                'formulir_id' => $formulir?->id,
                'is_read' => false,
                'read_at' => null,
            ]);
        }

        // Notifikasi tipe: formulir_approved
        foreach ($approvedUsers->take(2) as $user) {
            $formulir = $formulirs->where('user_id', $user->id)->first() ?? $formulirs->first();

            Notifikasi::create([
                'user_id' => $user->id,
                'judul' => 'Formulir Disetujui',
                'pesan' => 'Selamat! Formulir pengajuan ITSA Anda telah disetujui. Silakan cek hasil pada menu Riwayat.',
                'type' => 'formulir_approved',
                'feedback_id' => null,
                'formulir_id' => $formulir?->id,
                'is_read' => false,
                'read_at' => null,
            ]);
        }

        // Notifikasi tipe: formulir_rejected
        foreach ($approvedUsers->skip(3)->take(2) as $user) {
            $formulir = $formulirs->where('user_id', $user->id)->first() ?? $formulirs->first();

            Notifikasi::create([
                'user_id' => $user->id,
                'judul' => 'Formulir Ditolak',
                'pesan' => 'Mohon maaf, formulir pengajuan ITSA Anda ditolak. Silakan periksa keterangan dan ajukan ulang.',
                'type' => 'formulir_rejected',
                'feedback_id' => null,
                'formulir_id' => $formulir?->id,
                'is_read' => false,
                'read_at' => null,
            ]);
        }

        // Beberapa notifikasi yang sudah dibaca
        foreach ($approvedUsers->take(2) as $user) {
            Notifikasi::create([
                'user_id' => $user->id,
                'judul' => 'Selamat Datang',
                'pesan' => 'Selamat datang di sistem ITSA Dinkominfo Banyumas. Silakan lengkapi profil Anda.',
                'type' => 'info',
                'feedback_id' => null,
                'formulir_id' => null,
                'is_read' => true,
                'read_at' => now()->subDays(rand(1, 7)),
            ]);
        }

        $this->command->info('Seeder Notifikasi berhasil dijalankan.');
    }
}
