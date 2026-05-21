<?php

namespace App\Actions\Patients;

use App\Actions\Activity\RecordActivity;
use App\Enums\ActivityEvent;
use App\Enums\ActivityVisibility;
use App\Enums\PatientStatus;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\User;
use Exception;

class CreatePatient
{
    /**
     * @throws Exception
     */
    public function handle(Clinic $clinic, User $actor, array $data): Patient
    {
        $patient = Patient::create([
            'clinic_id' => $clinic->id,
            'assigned_doctor_id' => $data['assigned_doctor_id'] ?? null,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'birth_date' => $data['birth_date'] ?? null,
            'status' => PatientStatus::Waiting,
            'notes' => $data['notes'] ?? null,
        ]);

        app(RecordActivity::class)->handle(
            clinic: $clinic,
            event: ActivityEvent::PatientCreated,
            visibility: ActivityVisibility::Operational,
            patient: $patient,
            actor: $actor,
            subject: $patient,
            payload: [
                'patient_name' => $patient->full_name,
            ],
        );

        return $patient;
    }
}
