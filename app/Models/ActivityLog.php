<?php

namespace App\Models;

use App\Enums\ActivityEvent;
use App\Enums\ActivityVisibility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ActivityLog extends Model
{
    protected $fillable = [
      'clinic_id',
      'patient_id',
      'actor_id',
      'event',
      'visibility',
      'subject_type',
      'subject_id',
      'payload',
    ];

    protected function casts(): array
    {
        return [
          'event' => ActivityEvent::class,
          'visibility' => ActivityVisibility::class,
          'payload' => 'array',
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

    public function actor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'actor_id');
    }

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }
}
