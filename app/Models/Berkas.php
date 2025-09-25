<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\BelongsToRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Berkas extends Model
{
    use HasFactory;

    protected $fillable = [
        'noberkas',
        'tglberkas',
        'kabkota_id',
        'kapkem_id',
        'kalkel_id',
        'padkam_id',
        // 'album_id',
        'alashak',
        'luas',
        'nik',
        'nama',
        'tmplahir',
        'tgllahir',
        'alamat',
        'nohp',
        'permohonan',
        'biaya',
        'statshm_id',
        'shmsg_id',
        'alashak_sg',
        'utuhseb_id',
        'catatan_berkas',
        'upload_berkas',
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
        'alamat',
        'upload_fotolap',
        'upload_surveylap',
        'upload_gu',
        'upload_dwg',
        'penggunaan_id',
        'ket',
        'no_gs',
        'tgl_gs',
        'upload_gs',
        'pisungsung',
        'serat_id',
        'hak_id',
        'no_serat',
        'tgl_serat',
        'jangka_waktu',
        'tgl_akhir',
        'statsubyek_id',
        'nik_pemegang',
        'nama_pemegang',
        'tmplahir_Pemegang',
        'tgllahir_pemegang',
        'alamat_pemegang',
        'acc_penghageng',
        'cat_penghageng',
        'tgl_penghageng',
        // 'no_warkah',
        // 'tgl_warkah',
        'upload_serat',
        'no_di301a',
        'tgl_di301a',
        'tgl_serah',
        // 'is_warkah',
    ];

    protected $casts = [
        'permohonan' => 'array',
        'upload_fotolap' => 'array',
    ];

    // protected $dates = [
    //     'tgl_301a',
    // ];

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

    public function statsubyek(): BelongsTo
    {
        return $this->belongsTo(Statsubyek::class);
    }

    public function serat(): BelongsTo
    {
        return $this->belongsTo(Serat::class);
    }

    public function hak(): BelongsTo
    {
        return $this->belongsTo(Hak::class);
    }

    public function posisi(): BelongsTo
    {
        return $this->belongsTo(Posisi::class);
    }

    public function statshm(): BelongsTo
    {
        return $this->belongsTo(Statshm::class);
    }

    public function utuhseb(): BelongsTo
    {
        return $this->belongsTo(Utuhseb::class);
    }

    public function adabangunan(): BelongsTo
    {
        return $this->belongsTo(Adabangunan::class);
    }

    public function kondbangunan(): BelongsTo
    {
        return $this->belongsTo(Kondbangunan::class);
    }

    public function penggunaan(): BelongsTo
    {
        return $this->belongsTo(Penggunaan::class);
    }

    public function umr(): BelongsTo
    {
        return $this->belongsTo(umr::class);
    }

    public function abdi(): BelongsTo
    {
        return $this->belongsTo(Abdi::class);
    }

    public function biaya(): BelongsTo
    {
        return $this->belongsTo(Biaya::class);
    }

    public function warkah(): HasMany
    {
        return $this->hasMany(Warkah::class);
    }
}
