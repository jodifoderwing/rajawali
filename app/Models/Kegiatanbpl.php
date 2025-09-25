<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kegiatanbpl extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_tugas',
        'tgl_tugas',
        'tugas',
        'arahan',
        'status',
        'bidangbpl_id'
    ];

    public function pelaksanaanbpl(): HasMany
    {
        return $this->hasMany(Pelaksanaanbpl::class);
    }

    public function bidangbpl(): BelongsTo
    {
        return $this->belongsTo(Bidangbpl::class);
    }
}
