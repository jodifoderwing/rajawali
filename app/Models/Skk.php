<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skk extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'no_hp', 'jabatan'];

    public function skkwilayah(): HasMany
    {
        return $this->hasMany(Skkwilayah::class);
    }
}
