<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plpgwilayah extends Model
{
    use HasFactory;

    protected $fillable = ['plpg_id', 'skwwilayah_id', 'nama'];

    public function skwwilayah(): BelongsTo
    {
        return $this->belongsTo(Skwwilayah::class);
    }
}
