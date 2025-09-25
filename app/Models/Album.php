<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'start_warkah',
        'end_warkah',
        'lokasi',
        'qty_warkah',
    ];

    public function warkah(): HasMany
    {
        return $this->hasMany(Warkah::class);
    }
}
