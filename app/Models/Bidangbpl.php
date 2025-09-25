<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bidangbpl extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    // public function kegiatanbpl(): HasMany
    // {
    //     return $this->hasMany(Kegiatanbpl::class);
    // }
}
