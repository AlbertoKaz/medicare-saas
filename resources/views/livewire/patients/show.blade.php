@php
    use App\Enums\PatientStatus;
@endphp

<div class="min-h-screen bg-slate-50">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">

                <div>
                    <p class="text-sm font-semibold text-blue-600">
                        Patient workspace
                    </p>

                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-950">
                        {{ $patient->full_name }}
                    </h1>

                    <div class="mt-4 flex flex-wrap items-center gap-3">
                        <span
                            @class([
                                'inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold ring-1 ring-inset',

                                'bg-amber-50 text-amber-700 ring-amber-200'
                                    => $patient->status === PatientStatus::Waiting,

                                'bg-blue-50 text-blue-700 ring-blue-200'
                                    => $patient->status === PatientStatus::Active,

                                'bg-emerald-50 text-emerald-700 ring-emerald-200'
                                    => $patient->status === PatientStatus::InTreatment,

                                'bg-violet-50 text-violet-700 ring-violet-200'
                                    => $patient->status === PatientStatus::FollowUp,

                                'bg-slate-50 text-slate-700 ring-slate-200'
                                    => $patient->status === PatientStatus::Inactive,

                                'bg-zinc-50 text-zinc-700 ring-zinc-200'
                                    => $patient->status === PatientStatus::Discharged,
                            ])
                        >
                            <i class="fa-solid fa-circle text-[6px]"></i>
                            {{ str($patient->status->name)->headline() }}
                        </span>

                        @if($patient->assignedDoctor)
                            <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-medium text-slate-700">
                                <i class="fa-solid fa-user-doctor text-slate-400"></i>
                                Assigned to {{ $patient->assignedDoctor->name }}
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-medium text-slate-600">
                                <i class="fa-solid fa-user-doctor text-slate-400"></i>
                                No doctor assigned
                            </span>
                        @endif
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row">
                    @if($canViewClinicalNotes)
                        <a
                            href="{{ route('patients.clinical-notes.create', $patient) }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                        >
                            <i class="fa-solid fa-notes-medical text-xs text-emerald-600"></i>
                            Add clinical note
                        </a>
                    @endif

                    <a
                        href="{{ route('patients.appointments.create', $patient) }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                    >
                        <i class="fa-solid fa-calendar-plus text-xs"></i>
                        Schedule appointment
                    </a>
                </div>
            </div>
        </div>

        {{-- Patient status / Assigned doctor --}}
        <div class="mb-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
            <div class="grid gap-6 lg:grid-cols-2">

                {{-- Patient status --}}
                <div>
                    <h2 class="text-base font-semibold text-slate-950">
                        Patient status
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Update the general lifecycle state of this patient case.
                    </p>

                    <select
                        wire:change="changeStatus($event.target.value)"
                        class="mt-4 block h-11 w-full rounded-2xl border border-slate-300 bg-white px-4 text-sm text-slate-900 shadow-sm transition focus:border-blue-500 focus:ring-blue-500"
                    >
                        @foreach(PatientStatus::cases() as $status)
                            <option
                                value="{{ $status->value }}"
                                @selected($patient->status === $status)
                            >
                                {{ str($status->name)->headline() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Assigned doctor --}}
                <div>
                    <h2 class="text-base font-semibold text-slate-950">
                        Assigned doctor
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Assign the responsible doctor for this patient.
                    </p>

                    <div class="mt-4 flex gap-3">
                        <select
                            wire:model="assigned_doctor_id"
                            class="block h-11 w-full rounded-2xl border border-slate-300 bg-white px-4 text-sm text-slate-900 shadow-sm transition focus:border-blue-500 focus:ring-blue-500"
                        >
                            <option value="">Unassigned</option>

                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}">
                                    {{ $doctor->name }}
                                </option>
                            @endforeach
                        </select>

                        <button
                            wire:click="assignDoctor"
                            type="button"
                            class="inline-flex shrink-0 items-center justify-center gap-2 rounded-2xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                        >
                            <i class="fa-solid fa-user-doctor text-xs"></i>
                            Assign
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">

            {{-- Main column --}}
            <div class="space-y-6 lg:col-span-2">

                {{-- Timeline --}}
                <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
                    <div class="mb-6 flex items-start justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-semibold text-slate-950">
                                Timeline
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Recent operational and clinical activity.
                            </p>
                        </div>

                        <span class="rounded-full bg-slate-100 px-3 py-1 text-sm font-medium text-slate-600">
                            {{ $this->visibleActivities()->count() }} events
                        </span>
                    </div>

                    <div class="space-y-0">
                        @forelse($this->visibleActivities() as $activity)
                            <div class="relative pb-6 pl-9 last:pb-0">

                                @if(! $loop->last)
                                    <div class="absolute left-2.75 top-6 h-full w-px bg-slate-200"></div>
                                @endif

                                @php
                                    $activityIcon = match($activity->event->value) {
                                        'patient_created' => 'fa-user-plus',
                                        'appointment_scheduled' => 'fa-calendar-plus',
                                        'patient_status_changed' => 'fa-arrow-right-arrow-left',
                                        'clinical_note_added' => 'fa-notes-medical',
                                        'doctor_assigned','doctor_unassigned' => 'fa-user-doctor',
                                        default => 'fa-circle',
                                    };
                                @endphp

                                <div
                                    @class([
                                        'absolute left-0 top-0 flex h-6 w-6 items-center justify-center rounded-full ring-4 ring-white',

                                        'bg-blue-100 text-blue-600'
                                            => $activity->visibility->isOperational(),

                                        'bg-emerald-100 text-emerald-600'
                                            => $activity->visibility->isClinical(),

                                        'bg-amber-100 text-amber-600'
                                            => $activity->visibility->isPrivate(),

                                        'bg-slate-100 text-slate-500'
                                            => $activity->visibility->isSystem(),
                                    ])
                                >
                                    <i class="fa-solid {{ $activityIcon }} text-[10px]"></i>
                                </div>

                                <div class="rounded-2xl border border-slate-100 bg-slate-50/60 p-4">
                                    <p class="text-sm font-semibold text-slate-950">
                                        {{ str($activity->event->value)->replace('_', ' ')->title() }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        {{ $activity->actor?->name ?? 'System' }}
                                        ·
                                        {{ $activity->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="rounded-2xl border border-dashed border-slate-200 p-8 text-center">
                                <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                    <i class="fa-solid fa-wave-square"></i>
                                </div>

                                <p class="mt-4 text-sm font-medium text-slate-700">
                                    No activity yet.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </section>

                {{-- Clinical Notes --}}
                @if($canViewClinicalNotes)
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
                        <div class="mb-6 flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-lg font-semibold text-slate-950">
                                    Clinical Notes
                                </h2>

                                <p class="mt-1 text-sm text-slate-500">
                                    Sensitive clinical information visible only to authorized roles.
                                </p>
                            </div>

                            <span class="rounded-full bg-emerald-50 px-3 py-1 text-sm font-medium text-emerald-700">
                                {{ $patient->clinicalNotes->count() }} notes
                            </span>
                        </div>

                        <div class="space-y-4">
                            @forelse($patient->clinicalNotes->sortByDesc('created_at') as $note)
                                <div class="rounded-2xl border border-emerald-100 bg-emerald-50/30 p-4">
                                    <div class="mb-3 flex items-center justify-between gap-3">
                                        <p class="text-sm font-medium text-slate-700">
                                            <i class="fa-solid fa-user-doctor mr-1.5 text-xs text-emerald-600"></i>
                                            {{ $note->author?->name }}
                                        </p>

                                        <p class="text-xs text-slate-500">
                                            {{ $note->created_at->diffForHumans() }}
                                        </p>
                                    </div>

                                    <div class="whitespace-pre-line text-sm leading-6 text-slate-800">
                                        {{ $note->content }}
                                    </div>
                                </div>
                            @empty
                                <div class="rounded-2xl border border-dashed border-slate-200 p-8 text-center">
                                    <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                        <i class="fa-solid fa-notes-medical"></i>
                                    </div>

                                    <p class="mt-4 text-sm font-medium text-slate-700">
                                        No clinical notes yet.
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </section>
                @endif

            </div>

            {{-- Sidebar --}}
            <aside class="space-y-6">

                {{-- Appointments --}}
                <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
                    <div class="mb-5 flex items-start justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-semibold text-slate-950">
                                Appointments
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Scheduled visits and operational appointments.
                            </p>
                        </div>

                        <span class="rounded-full bg-blue-50 px-3 py-1 text-sm font-medium text-blue-700">
                            {{ $patient->appointments->count() }}
                        </span>
                    </div>

                    <div class="space-y-3">
                        @forelse($patient->appointments as $appointment)
                            <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4">
                                <div class="flex items-start gap-3">
                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                                        <i class="fa-solid fa-calendar-check text-xs"></i>
                                    </div>

                                    <div>
                                        <p class="text-sm font-semibold text-slate-950">
                                            {{ str($appointment->visit_type->value)->headline() }}
                                        </p>

                                        <p class="mt-1 text-sm text-slate-500">
                                            {{ $appointment->starts_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="rounded-2xl border border-dashed border-slate-200 p-6 text-center">
                                <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                    <i class="fa-solid fa-calendar-day"></i>
                                </div>

                                <p class="mt-4 text-sm font-medium text-slate-700">
                                    No appointments yet.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </section>

            </aside>

        </div>
    </div>
</div>
