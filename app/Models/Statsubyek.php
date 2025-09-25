<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Statsubyek extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    // public function berkas(): HasMany
    // {
    //     return $this->hasMany(Berkas::class);
    // }
}
