<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ukur extends Model
{
    use HasFactory;

    protected $fillable = ['survey_id'];

    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class);
    }

    public function surveyDetails(): HasMany
    {
        // Pakai foreign key survey_id pada tabel survey_details
        return $this->hasMany(Surveydetail::class, 'survey_id', 'survey_id');
    }
}
