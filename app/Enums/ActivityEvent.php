<?php

namespace App\Enums;

enum ActivityEvent: string
{
    case PatientCreated = 'patient_created';
    case AppointmentScheduled='appointment_scheduled';
    case ClinicalNoteAdded = 'clinical_note_added';
    case PatientStatusChanged = 'patient_status_changed';
}
