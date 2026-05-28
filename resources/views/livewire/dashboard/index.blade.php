@php
    use App\Enums\PatientStatus;
    use App\Enums\ClinicRole;
@endphp

<div class="min-h-screen bg-slate-50">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        @php
            $membership = auth()
                ->user()
                ->clinicMemberships()
                ->where('clinic_id', currentClinic()->id)
                ->first();
        @endphp

        {{-- Header --}}
        <div class="mb-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-medium text-blue-600">
                        Clinical workspace
                    </p>

                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-950">
                        Dashboard
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Operational overview for {{ currentClinic()->name }}.
                    </p>
                </div>

                @if($membership)
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">
                            <i class="fa-solid fa-hospital text-slate-400"></i>
                            {{ currentClinic()->name }}
                        </span>

                        <span
                            @class([
                                'inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold',

                                'bg-violet-100 text-violet-700'
                                    => $membership->role === ClinicRole::Owner,

                                'bg-blue-100 text-blue-700'
                                    => $membership->role === ClinicRole::Admin,

                                'bg-emerald-100 text-emerald-700'
                                    => $membership->role === ClinicRole::Doctor,

                                'bg-amber-100 text-amber-700'
                                    => $membership->role === ClinicRole::Assistant,
                            ])
                        >
                            <i class="fa-solid fa-user-shield opacity-70"></i>
                            {{ str($membership->role->value)->headline() }}
                        </span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Quick actions --}}
        <div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            <a
                href="{{ route('patients.index') }}"
                class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200/60 transition hover:-translate-y-0.5 hover:border-blue-200 hover:bg-blue-50/40"
            >
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <p class="text-sm font-semibold text-slate-900 group-hover:text-blue-700">
                        Patients
                    </p>
                </div>

                <p class="mt-3 text-sm text-slate-500">
                    View and manage patient records.
                </p>
            </a>

            <a
                href="{{ route('patients.create') }}"
                class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200/60 transition hover:-translate-y-0.5 hover:border-blue-200 hover:bg-blue-50/40"
            >
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>

                    <p class="text-sm font-semibold text-slate-900 group-hover:text-blue-700">
                        New patient
                    </p>
                </div>

                <p class="mt-3 text-sm text-slate-500">
                    Register a new patient.
                </p>
            </a>

            <a
                href="#today-appointments"
                class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200/60 transition hover:-translate-y-0.5 hover:border-blue-200 hover:bg-blue-50/40"
            >
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>

                    <p class="text-sm font-semibold text-slate-900 group-hover:text-blue-700">
                        Today’s appointments
                    </p>
                </div>

                <p class="mt-3 text-sm text-slate-500">
                    Review scheduled visits.
                </p>
            </a>

            <a
                href="#patients-attention"
                class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200/60 transition hover:-translate-y-0.5 hover:border-blue-200 hover:bg-blue-50/40"
            >
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>

                    <p class="text-sm font-semibold text-slate-900 group-hover:text-blue-700">
                        Needs attention
                    </p>
                </div>

                <p class="mt-3 text-sm text-slate-500">
                    Check patients requiring action.
                </p>
            </a>
        </div>

        {{-- KPIs --}}
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Active patients
                    </p>

                    <i class="fa-solid fa-user-group text-blue-500"></i>
                </div>

                <p class="mt-4 text-4xl font-semibold tracking-tight text-slate-950">
                    {{ $activePatients }}
                </p>

                <p class="mt-2 text-sm text-slate-500">
                    Active or in treatment.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Appointments today
                    </p>

                    <i class="fa-solid fa-calendar-day text-cyan-500"></i>
                </div>

                <p class="mt-4 text-4xl font-semibold tracking-tight text-slate-950">
                    {{ $todayAppointments }}
                </p>

                <p class="mt-2 text-sm text-slate-500">
                    Scheduled visits today.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Pending follow-ups
                    </p>

                    <i class="fa-solid fa-user-clock text-violet-500"></i>
                </div>

                <p class="mt-4 text-4xl font-semibold tracking-tight text-slate-950">
                    {{ $followUps }}
                </p>

                <p class="mt-2 text-sm text-slate-500">
                    Patients awaiting action.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Recent activity
                    </p>

                    <i class="fa-solid fa-wave-square text-emerald-500"></i>
                </div>

                <p class="mt-4 text-4xl font-semibold tracking-tight text-slate-950">
                    {{ $recentActivity->count() }}
                </p>

                <p class="mt-2 text-sm text-slate-500">
                    Latest visible events.
                </p>
            </div>
        </div>

        <div id="today-appointments" class="mt-8 grid gap-6 lg:grid-cols-3">

            {{-- Today's appointments --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60 lg:col-span-2">

                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-950">
                            Today's appointments
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Scheduled clinical activity for today.
                        </p>
                    </div>

                    <span class="rounded-full bg-blue-50 px-3 py-1 text-sm font-medium text-blue-700">
                        {{ $appointmentsTodayList->count() }} scheduled
                    </span>
                </div>

                <div class="mt-6 space-y-3">
                    @forelse($appointmentsTodayList as $appointment)
                        <div class="flex items-center justify-between gap-4 rounded-2xl border border-slate-100 p-4 transition hover:border-blue-100 hover:bg-blue-50/30">
                            <div class="flex items-center gap-4">
                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                                    <i class="fa-solid fa-calendar-check"></i>
                                </div>

                                <div>
                                    <p class="font-medium text-slate-950">
                                        {{ $appointment->patient->full_name }}
                                    </p>

                                    <p class="mt-1 text-sm text-slate-500">
                                        {{ str($appointment->visit_type->value)
                                            ->replace('_', ' ')
                                            ->title() }}
                                    </p>
                                </div>
                            </div>

                            <div class="text-right">
                                <p class="font-semibold text-blue-600">
                                    {{ $appointment->starts_at->format('H:i') }}
                                </p>

                                @if($appointment->assignedDoctor)
                                    <p class="mt-1 text-sm text-slate-500">
                                        {{ $appointment->assignedDoctor->name }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-200 p-8 text-center">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                <i class="fa-solid fa-calendar-day"></i>
                            </div>

                            <p class="mt-4 text-sm font-medium text-slate-700">
                                No appointments scheduled today.
                            </p>

                            <p class="mt-1 text-sm text-slate-500">
                                The daily agenda is clear.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Recent Activity --}}
            <div id="recent-activity"
                class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
                <h2 class="text-lg font-semibold text-slate-950">
                    Recent activity
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Latest visible timeline events.
                </p>

                <div class="mt-6 space-y-0">
                    @forelse($recentActivity as $activity)
                        <div class="relative pb-6 pl-8 last:pb-0">

                            @if(! $loop->last)
                                <div class="absolute left-[11px] top-5 h-full w-px bg-slate-200"></div>
                            @endif

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
                                @php
                                    $activityIcon = match($activity->event->value) {
                                        'patient_created' => 'fa-user-plus',
                                        'appointment_scheduled' => 'fa-calendar-plus',
                                        'patient_status_changed' => 'fa-arrow-right-arrow-left',
                                        'clinical_note_added' => 'fa-notes-medical',
                                        default => 'fa-circle',
                                    };
                                @endphp

                                <i class="fa-solid {{ $activityIcon }} text-[10px]"></i>
                            </div>

                            <p class="text-sm font-semibold text-slate-950">
                                {{ str($activity->event->value)->replace('_', ' ')->title() }}
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                {{ $activity->actor?->name ?? 'System' }}
                                ·
                                {{ $activity->created_at->diffForHumans() }}
                            </p>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-200 p-6 text-center">
                            <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                <i class="fa-solid fa-wave-square"></i>
                            </div>

                            <p class="mt-4 text-sm font-medium text-slate-700">
                                No recent activity yet.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Patients Follow Up --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">

                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-950">
                            Patients requiring follow-up
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Patients waiting for next clinical action.
                        </p>
                    </div>

                    <span class="rounded-full bg-violet-100 px-3 py-1 text-sm font-medium text-violet-700">
                        {{ $patientsFollowUp->count() }}
                    </span>
                </div>

                <div class="mt-6 divide-y divide-slate-100">
                    @forelse($patientsFollowUp as $patient)
                        <a
                            href="{{ route('patients.show', $patient) }}"
                            class="flex items-center justify-between gap-4 py-4 transition hover:bg-violet-50/30"
                        >
                            <div>
                                <p class="font-medium text-slate-950">
                                    {{ $patient->full_name }}
                                </p>

                                <p class="mt-1 text-sm text-violet-600">
                                    <i class="fa-solid fa-user-clock mr-1 text-xs"></i>
                                    Follow up required
                                </p>
                            </div>

                            <div class="text-right">
                                <p class="text-xs text-slate-500">
                                    Updated
                                </p>

                                <p class="text-sm font-medium text-slate-700">
                                    {{ $patient->updated_at->diffForHumans() }}
                                </p>
                            </div>
                        </a>
                    @empty
                        <div class="py-8 text-center">
                            <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>

                            <p class="mt-4 text-sm font-medium text-slate-700">
                                No follow ups pending.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Patients Needing Attention --}}
            <div
                id="patients-attention"
                class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60 lg:col-span-2"
            >
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-950">
                            Patients needing attention
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Patients currently waiting or requiring follow-up.
                        </p>
                    </div>

                    <span class="rounded-full bg-amber-50 px-3 py-1 text-sm font-medium text-amber-700">
                        {{ $patientsNeedingAttention->count() }} patients
                    </span>
                </div>

                <div class="mt-6 divide-y divide-slate-100">
                    @forelse($patientsNeedingAttention as $patient)
                        <a
                            href="{{ route('patients.show', $patient) }}"
                            class="flex items-center justify-between gap-4 py-4 transition hover:bg-amber-50/30"
                        >
                            <div>
                                <p class="font-medium text-slate-950">
                                    {{ $patient->full_name }}
                                </p>

                                <div class="mt-2">
                                    <span
                                        @class([
                                            'inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium',

                                            'bg-amber-100 text-amber-700'
                                                => $patient->status === PatientStatus::Waiting,

                                            'bg-blue-100 text-blue-700'
                                                => $patient->status === PatientStatus::Active,

                                            'bg-emerald-100 text-emerald-700'
                                                => $patient->status === PatientStatus::InTreatment,

                                            'bg-purple-100 text-purple-700'
                                                => $patient->status === PatientStatus::FollowUp,

                                            'bg-slate-100 text-slate-700'
                                                => $patient->status === PatientStatus::Inactive,

                                            'bg-zinc-100 text-zinc-700'
                                                => $patient->status === PatientStatus::Discharged,
                                        ])
                                    >
                                        <i class="fa-solid fa-circle text-[6px]"></i>
                                        {{ str($patient->status->value)->replace('_', ' ')->title() }}
                                    </span>
                                </div>
                            </div>

                            <div class="text-right">
                                <p class="text-xs text-slate-500">
                                    Updated
                                </p>

                                <p class="text-sm font-medium text-slate-700">
                                    {{ $patient->updated_at->diffForHumans() }}
                                </p>
                            </div>
                        </a>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-200 p-8 text-center">
                            <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>

                            <p class="mt-4 text-sm font-medium text-slate-700">
                                No patients need attention right now.
                            </p>

                            <p class="mt-1 text-sm text-slate-500">
                                Everything looks stable.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>
