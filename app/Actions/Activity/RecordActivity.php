<?php /** @noinspection PhpUnused */

namespace App\Actions\Activity;

use App\Enums\ActivityEvent;
use App\Enums\ActivityVisibility;
use App\Models\ActivityLog;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class RecordActivity
{
    public function handle(
        Clinic $clinic,
        ActivityEvent $event,
        ActivityVisibility $visibility,
        ?Patient $patient = null,
        ?User $actor = null,
        ?Model $subject = null,
        array $payload = [],
    ): ActivityLog {
        return ActivityLog::create([
            'clinic_id' => $clinic->id,
            'patient_id' => $patient?->id,
            'actor_id' => $actor?->id,
            'event' => $event,
            'visibility' => $visibility,
            'subject_type' => $subject?->getMorphClass(),
            'subject_id' => $subject?->getKey(),
            'payload' => $payload,
        ]);
    }
}
