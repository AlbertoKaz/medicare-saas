<?php

namespace App\Actions\ClinicalNotes;

use App\Actions\Activity\RecordActivity;
use App\Enums\ActivityEvent;
use App\Enums\ActivityVisibility;
use App\Enums\ClinicalNoteVisibility;
use App\Models\ClinicalNote;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\User;

class AddClinicalNote
{
    public function handle(
        Clinic $clinic,
        User $actor,
        Patient $patient,
        array $data
    ): ClinicalNote {
        $clinicalNote = ClinicalNote::create([
            'clinic_id' => $clinic->id,
            'patient_id' => $patient->id,
            'author_id' => $actor->id,
            'content' => $data['content'],
            'visibility' => ClinicalNoteVisibility::Doctor,
        ]);

        app(RecordActivity::class)->handle(
            clinic: $clinic,
            event: ActivityEvent::ClinicalNoteAdded,
            visibility: ActivityVisibility::Clinical,
            patient: $patient,
            actor: $actor,
            subject: $clinicalNote,
            payload: [
                'author_name' => $actor->name,
            ],
        );

        return $clinicalNote;
    }
}
