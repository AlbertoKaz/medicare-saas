<?php

namespace App\Enums;

enum ActivityEvent: string
{
    case PatientCreated = 'patient_created';
    case AppointmentScheduled='appointment_scheduled';
}
