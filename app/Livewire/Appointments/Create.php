<?php /** @noinspection PhpUnused */

namespace App\Livewire\Appointments;

use App\Actions\Appointments\ScheduleAppointment;
use App\Enums\AppointmentType;
use App\Models\Patient;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    public Patient $patient;

    public ?int $assigned_doctor_id = null;

    public string $starts_at = '';

    public string $visit_type = '';

    public ?string $notes_operational = null;

    public function mount(Patient $patient): void
    {
        abort_unless(
            $patient->clinic_id === currentClinic()?->id,
            403
        );

        $this->patient = $patient;
    }

    public function save(
        ScheduleAppointment $scheduleAppointment
    ): void {

        $validated = $this->validate([
            'assigned_doctor_id' => [
                'nullable',
                'exists:users,id',
            ],

            'starts_at' => [
                'required',
                'date',
            ],

            'visit_type' => [
                'required',
                'in:consultation,follow_up,procedure',
            ],

            'notes_operational' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $scheduleAppointment->handle(
            clinic: currentClinic(),
            actor: auth()->user(),
            patient: $this->patient,
            data: $validated,
        );

        session()->flash(
            'success',
            'Appointment created.'
        );

        $this->redirect(
            route('patients.show', $this->patient)
        );
    }

    public function render(): Factory|View
    {
        return view(
            'livewire.appointments.create',
            [
                'appointmentTypes' =>
                    AppointmentType::cases(),
            ]
        );
    }
}
