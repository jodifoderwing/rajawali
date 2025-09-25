<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warkah extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_warkah',
        'tgl_warkah',
        'berkas_id',
        'album_id'
    ];

    public function berkas(): BelongsTo
    {
        return $this->belongsTo(Berkas::class);
    }
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
