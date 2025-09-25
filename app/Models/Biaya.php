<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;

    protected $fillable = ['biaya'];

    // Buat accessor di model (lebih rapi, bisa dipakai di mana-mana)
    // public function getBiayaDaftarFormattedAttribute(): string
    // {
    //     return number_format($this->biaya_daftar, 0, ',', '.');
    // }
}
