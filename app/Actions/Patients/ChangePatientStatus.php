<?php

namespace App\Actions\Patients;

use App\Actions\Activity\RecordActivity;
use App\Enums\ActivityEvent;
use App\Enums\ActivityVisibility;
use App\Enums\PatientStatus;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\User;

class ChangePatientStatus
{
    public function handle(
        Clinic $clinic,
        User $actor,
        Patient $patient,
        PatientStatus $newStatus
    ): Patient {

        $oldStatus = $patient->status;

        if ($oldStatus === $newStatus) {
            return $patient;
        }

        $patient->update([
            'status' => $newStatus,
        ]);

        app(RecordActivity::class)->handle(
            clinic: $clinic,

            event:
            ActivityEvent::PatientStatusChanged,

            visibility:
            ActivityVisibility::Operational,

            patient: $patient,

            actor: $actor,

            subject: $patient,

            payload: [

                'from' =>
                    $oldStatus->value,

                'to' =>
                    $newStatus->value,

            ],
        );

        return $patient;
    }
}
