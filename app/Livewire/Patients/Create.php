<?php /** @noinspection PhpUnused */

namespace App\Livewire\Patients;

use App\Actions\Patients\CreatePatient;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    public string $first_name = '';

    public string $last_name = '';

    public ?string $email = null;

    public ?string $phone = null;

    public ?string $birth_date = null;

    public ?int $assigned_doctor_id = null;

    public ?string $notes = null;

    public function save(CreatePatient $createPatient): void
    {
        $validated = $this->validate();

        $createPatient->handle(
            clinic: currentClinic(),
            actor: auth()->user(),
            data: $validated,
        );

        session()->flash('success', 'Patient created successfully.');

        $this->reset();
    }

    protected function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'birth_date' => ['nullable', 'date'],
            'assigned_doctor_id' => ['nullable', 'exists:users,id'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function render(): View
    {
        return view('livewire.patients.create');
    }
}
