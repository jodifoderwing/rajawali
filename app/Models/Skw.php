<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skw extends Model
{
    use HasFactory;

    protected $fillable = ['skk_id', 'nama', 'jabatan', 'no_hp'];

    public function skk(): BelongsTo
    {
        return $this->belongsTo(Skk::class);
    }

    public function skwwilayah(): HasMany
    {
        return $this->hasMany(Skwwilayah::class);
    }
}
