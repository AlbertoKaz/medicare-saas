<?php

namespace App\Models;

use App\Enums\ClinicalNoteVisibility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClinicalNote extends Model
{
    protected $fillable = [

        'clinic_id',

        'patient_id',

        'author_id',

        'content',

        'visibility',

    ];

    protected function casts(): array
    {
        return [

            'visibility' =>
                ClinicalNoteVisibility::class,

        ];
    }

    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
