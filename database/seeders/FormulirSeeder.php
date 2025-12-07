<?php

namespace Database\Seeders;

use App\Models\Formulir;
use App\Models\User;
use Illuminate\Database\Seeder;

class FormulirSeeder extends Seeder
{
    public function run(): void
    {
        $adminIrfan = User::where('email', 'irfanromadhonwidodo86@gmail.com')->first();

        $webPemerintah = [
            'simpeg.banyumaskab.go.id',
            'e-office.banyumaskab.go.id',
            'lpse.banyumaskab.go.id',
            'bkd.banyumaskab.go.id',
            'bapenda.banyumaskab.go.id',
            'pkk.banyumaskab.go.id',
            'perpusda.banyumaskab.go.id',
            'dindukcapil.banyumaskab.go.id',
            'dinkes.banyumaskab.go.id',
            'diskominfo.banyumaskab.go.id',
            'simrs.banyumaskab.go.id',
            'bappeda.banyumaskab.go.id',
            'simwas.banyumaskab.go.id',
            'sipp.banyumaskab.go.id',
            'simkada.banyumaskab.go.id',
            'jdih.banyumaskab.go.id',
            'dishub.banyumaskab.go.id',
            'simtaru.banyumaskab.go.id',
            'dinsos.banyumaskab.go.id',
        ];

        foreach ($webPemerintah as $domain) {
            Formulir::create([
                'user_id' => $adminIrfan->id,
                'nama_aplikasi' => strtoupper(strtok($domain, '.')),
                'domain_aplikasi' => $domain,
                'ip_jenis' => 'public',
                'ip_address' => '192.168.1.' . rand(2, 254),
                'pejabat_nama' => 'Irfan Romadhon Widodo',
                'pejabat_nip' => '197001011990031001',
                'pejabat_pangkat' => 'Pembina',
                'pejabat_jabatan' => 'Kepala Dinas',
                'tujuan_sistem' => 'Meningkatkan efisiensi layanan publik',
                'pengguna_sistem' => 'ASN dan masyarakat',
                'hosting' => 'Server lokal',
                'framework' => 'Laravel',
                'pengelola_sistem' => 'Tim IT Dinas',
                'jumlah_roles' => 3,
                'nama_roles' => 'Admin, Operator, User',
                'mekanisme_account' => 'Registrasi manual oleh admin',
                'mekanisme_kredensial' => 'Email & Password',
                'fitur_reset_password' => true,
                'pic_pengelola' => 'Ahmad Taufik',
                'keterangan_tambahan' => 'Butuh integrasi dengan SSO daerah',
                'balasan_admin' => null,
                'status' => 'diproses',
                'file_hasil_itsa' => null,
            ]);
        }
    }
}
