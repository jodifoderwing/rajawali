<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kekancingan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_arsip',
        'tgl_arsip',
        'nomor',
        'tanggal',
        'statsubyek_id',
        'nama',
        'jabatan',
        'alamat',
        'bertindak',
        'atas_nama',
        'berdasarkan',
        'kampung',
        'kabkota_id',
        'kapkem_id',
        'kalkel_id',
        'luas',
        'penggunaan',
        'jangka_waktu',
        'tgl_berakhir',
        'upload_kekancingan',
    ];

    public function kabkota(): BelongsTo
    {
        return $this->belongsTo(Kabkota::class);
    }

    public function kapkem(): BelongsTo
    {
        return $this->belongsTo(Kapkem::class);
    }

    public function kalkel(): BelongsTo
    {
        return $this->belongsTo(Kalkel::class);
    }

    public function statsubyek(): BelongsTo
    {
        return $this->belongsTo(Statsubyek::class);
    }

    public function penggunaan(): BelongsTo
    {
        return $this->belongsTo(Penggunaan::class);
    }
}
