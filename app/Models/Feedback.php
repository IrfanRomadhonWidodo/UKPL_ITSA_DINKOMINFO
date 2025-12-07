<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'user_id',
        'subjek',
        'pesan',
        'balasan_admin',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke user pengirim feedback.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Label untuk subjek (digunakan di tampilan).
     */
    public function getSubjekLabelAttribute()
    {
        $labels = [
            'masalah_teknis' => 'Masalah Teknis',
            'keluhan_layanan' => 'Keluhan Layanan',
            'saran_pengembangan' => 'Saran Pengembangan',
            'pertanyaan_informasi' => 'Pertanyaan Informasi',
        ];

        return $labels[$this->subjek] ?? $this->subjek;
    }

}
