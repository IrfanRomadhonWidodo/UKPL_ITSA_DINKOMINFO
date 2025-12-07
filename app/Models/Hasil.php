<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;

    protected $table = 'hasil_itsa';

    protected $fillable = [
        'formulir_id',
        'image',
        'deskripsi',
        'tautan',
    ];

    /**
     * Relasi ke Formulir (one-to-one)
     */
    public function formulir()
    {
        return $this->belongsTo(Formulir::class);
    }
}
