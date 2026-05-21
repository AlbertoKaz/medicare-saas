<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use App\Actions\Patients\ChangePatientStatus;
use App\Enums\PatientStatus;

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

    public function changeStatus(
        ChangePatientStatus $changePatientStatus,
        string $status
    ): void {

        $changePatientStatus->handle(
            clinic: currentClinic(),
            actor: auth()->user(),
            patient: $this->patient,
            newStatus: PatientStatus::from($status),
        );

        $this->patient->refresh();
    }

    public function render(): View
    {
        return view(
            'livewire.patients.show'
        );
    }
}
