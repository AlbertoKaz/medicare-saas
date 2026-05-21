<?php

namespace App\Actions\Appointments;

use App\Actions\Activity\RecordActivity;
use App\Enums\ActivityEvent;
use App\Enums\ActivityVisibility;
use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\User;

class ScheduleAppointment
{
    public function handle(
        Clinic $clinic,
        User $actor,
        Patient $patient,
        array $data
    ): Appointment {

        $appointment = Appointment::create([
            'clinic_id' => $clinic->id,

            'patient_id' => $patient->id,

            'assigned_doctor_id' =>
                $data['assigned_doctor_id']
                ?? null,

            'starts_at' => $data['starts_at'],

            'ends_at' => $data['ends_at']
                ?? null,

            'status' =>
                AppointmentStatus::Scheduled,

            'visit_type' =>
                $data['visit_type'],

            'notes_operational' =>
                $data['notes_operational']
                ?? null,
        ]);

        app(RecordActivity::class)->handle(
            clinic: $clinic,

            event:
            ActivityEvent::AppointmentScheduled,

            visibility:
            ActivityVisibility::Operational,

            patient: $patient,

            actor: $actor,

            subject: $appointment,

            payload: [
                'visit_type' =>
                    $appointment
                        ->visit_type
                        ->value,

                'starts_at' =>
                    $appointment
                        ->starts_at
                        ->toDateTimeString(),
            ],
        );

        return $appointment;
    }
}
