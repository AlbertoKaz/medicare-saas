<?php

namespace App\Livewire\Patients;

use App\Enums\PatientStatus;
use App\Models\Patient;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Index extends Component
{
    public function render(): View
    {
        return view('livewire.patients.index', [
            'patients' => Patient::query()
                ->where('clinic_id', currentClinic()->id)
                ->with('assignedDoctor')
                ->latest()
                ->get(),

            'patientStatus' => PatientStatus::class,
        ]);
    }
}
