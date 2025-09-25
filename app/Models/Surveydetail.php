<?php

namespace App\Models;

use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surveydetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'survey_id',
        'no_bidang',
        'nama',
        'statshm_id',
        'shmsg_id',
        'alashak_sg',
        'utuhseb_id',
        'alamat_tanah',
        'adabangunan_id',
        'kondbangunan_id',
        'posisi_id',
        'pekerjaan',
        'umr_id',
        'abdi_id',
        'tgl_ukur',
        'luas_ukur',
        'npk',
        'koordinat',
        'upload_fotolap',
        'upload_surveylap',
        'upload_gu',
        'penggunaan_id',
        'ket',
        'berkas_id'
    ];

    protected $casts = [
        'upload_fotolap' => 'array',
    ];

    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class);
    }

    public function ukur(): BelongsTo
    {
        return $this->belongsTo(Ukur::class, 'survey_id');
    }


    public function statshm(): BelongsTo
    {
        return $this->belongsTo(Statshm::class);
    }

    public function adabangunan(): BelongsTo
    {
        return $this->belongsTo(Adabangunan::class);
    }

    public function kondbangunan(): BelongsTo
    {
        return $this->belongsTo(Kondbangunan::class);
    }

    public function posisi(): BelongsTo
    {
        return $this->belongsTo(Posisi::class);
    }

    public function umr(): BelongsTo
    {
        return $this->belongsTo(umr::class);
    }

    public function abdi(): BelongsTo
    {
        return $this->belongsTo(Abdi::class);
    }

    public function utuhseb(): BelongsTo
    {
        return $this->belongsTo(Utuhseb::class);
    }

    public function penggunaan(): BelongsTo
    {
        return $this->belongsTo(Penggunaan::class);
    }

    protected static function booted(): void
    {
        static::created(function ($surveyDetail) {
            $surveyDetail->survey->update([
                'qty' => $surveyDetail->survey->surveyDetails()->count(),
            ]);
        });

        static::deleted(function ($surveyDetail) {
            $surveyDetail->survey->update([
                'qty' => $surveyDetail->survey->surveyDetails()->count(),
            ]);
        });
    }
}
