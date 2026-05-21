<?php

namespace App\Livewire\ClinicalNotes;

use App\Actions\ClinicalNotes\AddClinicalNote;
use App\Models\Patient;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    public Patient $patient;

    public string $content = '';

    public function mount(Patient $patient): void
    {
        abort_unless(
            $patient->clinic_id === currentClinic()?->id,
            403
        );

        $this->patient = $patient;
    }

    public function save(
        AddClinicalNote $addClinicalNote
    ): void {

        $validated = $this->validate([
            'content' => [
                'required',
                'string',
                'min:5',
            ],
        ]);

        $addClinicalNote->handle(
            clinic: currentClinic(),
            actor: auth()->user(),
            patient: $this->patient,
            data: $validated,
        );

        session()->flash(
            'success',
            'Clinical note created.'
        );

        $this->redirect(
            route(
                'patients.show',
                $this->patient
            )
        );
    }

    public function render(): View
    {
        return view(
            'livewire.clinical-notes.create'
        );
    }
}
