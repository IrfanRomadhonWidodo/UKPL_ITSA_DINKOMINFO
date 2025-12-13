<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Formulir>
 */
class FormulirFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nama_aplikasi' => fake()->company(),
            'domain_aplikasi' => fake()->domainName(),
            'ip_jenis' => fake()->randomElement(['public', 'lokal']),
            'ip_address' => fake()->ipv4(),
            'pejabat_nama' => fake()->name(),
            'pejabat_nip' => fake()->numerify('##################'),
            'pejabat_pangkat' => 'Pembina',
            'pejabat_jabatan' => 'Kepala Dinas',
            'tujuan_sistem' => fake()->sentence(),
            'pengguna_sistem' => 'ASN dan masyarakat',
            'hosting' => 'Server lokal',
            'framework' => 'Laravel',
            'pengelola_sistem' => 'Tim IT',
            'jumlah_roles' => fake()->numberBetween(1, 5),
            'nama_roles' => 'Admin, User',
            'mekanisme_account' => 'Registrasi',
            'mekanisme_kredensial' => 'Password',
            'fitur_reset_password' => true,
            'pic_pengelola' => fake()->name(),
            'keterangan_tambahan' => fake()->sentence(),
            'status' => 'diproses',
            'balasan_admin' => null,
            'file_hasil_itsa' => null,
        ];
    }
}
