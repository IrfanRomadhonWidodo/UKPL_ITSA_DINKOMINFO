<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulir extends Model
{
    use HasFactory;

    protected $table = 'formulir';

    protected $fillable = [
        'user_id',
        'nama_aplikasi',
        'domain_aplikasi',
        'ip_jenis',
        'ip_address',
        'pejabat_nama',
        'pejabat_nip',
        'pejabat_pangkat',
        'pejabat_jabatan',
        'tujuan_sistem',
        'pengguna_sistem',
        'hosting',
        'framework',
        'pengelola_sistem',
        'jumlah_roles',
        'nama_roles',
        'mekanisme_account',
        'mekanisme_kredensial',
        'fitur_reset_password',
        'pic_pengelola',
        'keterangan_tambahan',
        'balasan_admin',
        'status',
        'file_hasil_itsa',
    ];

    /**
     * Relasi ke model User (many-to-one)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hasilItsa()
    {
        return $this->hasOne(Hasil::class);
    }

}
