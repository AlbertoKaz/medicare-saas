<?php /** @noinspection PhpUnused */

namespace App\Actions\Patients;

use App\Enums\PatientStatus;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\User;

class CreatePatient
{
    public function handle(Clinic $clinic, User $actor, array $data): Patient
    {
        return Patient::create([
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
    }
}
