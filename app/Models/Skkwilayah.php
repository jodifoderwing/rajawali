<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skkwilayah extends Model
{
    use HasFactory;

    protected $fillable = ['skk_id', 'nama'];

    public function skk(): BelongsTo
    {
        return $this->belongsTo(Skk::class);
    }
}
