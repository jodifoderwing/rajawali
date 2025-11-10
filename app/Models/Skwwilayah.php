<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skwwilayah extends Model
{
    use HasFactory;

    protected $fillable = ['skw_id', 'skkwilayah_id', 'nama'];

    public function skkwilayah(): BelongsTo
    {
        return $this->belongsTo(Skkwilayah::class);
    }
}
