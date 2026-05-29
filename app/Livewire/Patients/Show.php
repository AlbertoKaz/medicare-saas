<?php

namespace App\Livewire\Patients;

use App\Actions\Patients\AssignDoctor;
use App\Enums\ClinicRole;
use App\Models\ClinicalNote;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use App\Actions\Patients\ChangePatientStatus;
use App\Enums\PatientStatus;

class Show extends Component
{
    public Patient $patient;
    public bool $canViewClinicalNotes = false;
    public ?int $assigned_doctor_id = null;

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
            'clinicalNotes.author',
        ]);

        $this->assigned_doctor_id = $this->patient->assigned_doctor_id;

        $this->canViewClinicalNotes = auth()
            ->user()
            ->can('viewAny', ClinicalNote::class);
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

    public function visibleActivities()
    {
        $user = auth()->user();

        return $this->patient
            ->activityLogs
            ->filter(function ($activity) use ($user) {
                if ($activity->visibility->isOperational()) {
                    return true;
                }

                if ($activity->visibility->isClinical()) {
                    return $user->can(
                        'viewAny',
                        ClinicalNote::class
                    );
                }

                return false;
            })
            ->sortByDesc('created_at');
    }

    public function assignDoctor(AssignDoctor $assignDoctor): void
    {
        $validated = $this->validate([
            'assigned_doctor_id' => [
                'nullable',
                'exists:users,id',
            ],
        ]);

        $doctor = null;

        if ($validated['assigned_doctor_id']) {
            $doctor = User::query()
                ->whereHas('clinicMemberships', function ($query) {
                    $query
                        ->where('clinic_id', currentClinic()->id)
                        ->where('role', ClinicRole::Doctor);
                })
                ->findOrFail($validated['assigned_doctor_id']);
        }

        $this->patient = $assignDoctor->handle(
            clinic: currentClinic(),
            actor: auth()->user(),
            patient: $this->patient,
            doctor: $doctor,
        );

        session()->flash('success', 'Doctor assigned successfully.');
    }

    public function render(): View
    {
        return view('livewire.patients.show', [
            'doctors' => User::query()
                ->whereHas('clinicMemberships', function ($query) {
                    $query
                        ->where('clinic_id', currentClinic()->id)
                        ->where('role', ClinicRole::Doctor);
                })
                ->orderBy('name')
                ->get(),
        ]);
    }
}
