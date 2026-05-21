<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Livewire\Component;

class Show extends Component
{
    public Patient $patient;

    public function mount(Patient $patient): void
    {
        abort_unless(
            $patient->clinic_id === currentClinic()?->id,
            403
        );

        $this->patient = $patient->load([
            'assignedDoctor',
            'appointments',
            'activityLogs.actor',
        ]);
    }

    public function render()
    {
        return view(
            'livewire.patients.show'
        );
    }
}
