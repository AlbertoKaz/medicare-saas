<?php

namespace App\Actions\Patients;

use App\Actions\Activity\RecordActivity;
use App\Enums\ActivityEvent;
use App\Enums\ActivityVisibility;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\User;

class AssignDoctor
{
    public function handle(
        Clinic $clinic,
        User $actor,
        Patient $patient,
        ?User $doctor
    ): Patient {
        abort_unless($patient->clinic_id === $clinic->id, 403);

        $patient->update([
            'assigned_doctor_id' => $doctor?->id,
        ]);

        $event = $doctor
            ? ActivityEvent::DoctorAssigned
            : ActivityEvent::DoctorUnassigned;

        app(RecordActivity::class)->handle(
            clinic: $clinic,
            event: $event,
            visibility: ActivityVisibility::Operational,
            patient: $patient,
            actor: $actor,
            subject: $patient,
            payload: [
                'doctor_name' => $doctor?->name,
            ],
        );

        return $patient->refresh();
    }
}
