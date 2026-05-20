<?php

use App\Models\Clinic;

if (! function_exists('currentClinic')) {

    function currentClinic(): ?Clinic
    {
        $clinicId = session('current_clinic_id');

        if (! $clinicId) {
            return null;
        }

        return Clinic::find($clinicId);
    }
}
