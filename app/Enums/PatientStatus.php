<?php

namespace App\Enums;

enum PatientStatus: string
{
    case Waiting = 'waiting';
    case Active = 'active';
    case InTreatment = 'in_treatment';
    case FollowUp = 'follow_up';
    case Discharged = 'discharged';
    case Inactive = 'inactive';
}
