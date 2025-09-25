<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelaksanaanbpl extends Model
{
    use HasFactory;

    protected $fillable = [
        'kegiatanbpl_id',
        'petugasbpl_id',
        'tgl_tugas',
        'tgl_terima',
        'tgl_selesai',
        'kabkota_id',
        'kapkem_id',
        'kalkel_id',
        'padkam_id',
        'kronologi',
        'identifikasi',
        'upload_foto',
        'upload_dokumen',
        'solusi',
        'status'
    ];

    protected $casts = [
        'upload_foto' => 'array',
        'upload_dokumen' => 'array',
    ];

    public function kegiatanbpl(): BelongsTo
    {
        return $this->belongsTo(Kegiatanbpl::class);
    }

    public function petugasbpl(): BelongsTo
    {
        return $this->belongsTo(Petugasbpl::class);
    }

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

    public function padkam(): BelongsTo
    {
        return $this->belongsTo(Padkam::class);
    }
}
