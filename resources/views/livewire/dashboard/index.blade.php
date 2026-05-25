@php
    use App\Enums\PatientStatus;
    use App\Enums\ClinicRole;
@endphp

<div class="min-h-screen bg-slate-50">

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-slate-950">
                Dashboard
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Operational overview for {{ currentClinic()->name }}
            </p>

            @php
                $membership = auth()
                    ->user()
                    ->clinicMemberships()
                    ->where(
                        'clinic_id',
                        currentClinic()->id
                    )
                    ->first();
            @endphp

            @if($membership)

                <span
                    @class([

                        'inline-flex rounded-full px-3 py-1 text-xs font-semibold',

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
                    {{ str($membership->role->value)->headline() }}
                </span>

            @endif
        </div>

        {{-- Menú --}}
        <div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            <a
                href="{{ route('patients.index') }}"
                class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200/60 transition hover:border-blue-200 hover:bg-blue-50/40"
            >
                <p class="text-sm font-semibold text-slate-900">
                    Patients
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    View and manage patient records.
                </p>
            </a>

            <a
                href="{{ route('patients.create') }}"
                class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200/60 transition hover:border-blue-200 hover:bg-blue-50/40"
            >
                <p class="text-sm font-semibold text-slate-900">
                    New patient
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    Register a new patient.
                </p>
            </a>

            <a
                href="#today-appointments"
                class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200/60 transition hover:border-blue-200 hover:bg-blue-50/40"
            >
                <p class="text-sm font-semibold text-slate-900">
                    Today’s appointments
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    Review scheduled visits.
                </p>
            </a>

            <a
                href="#patients-attention"
                class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-200/60 transition hover:border-blue-200 hover:bg-blue-50/40"
            >
                <p class="text-sm font-semibold text-slate-900">
                    Needs attention
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    Check patients requiring action.
                </p>
            </a>

        </div>

        {{-- 4 KPI --}}
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
                <p class="text-sm font-medium text-gray-500">
                    Active patients
                </p>

                <p class="mt-2 text-4xl font-semibold tracking-tight text-slate-900">
                    {{ $activePatients }}
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
                <p class="text-sm font-medium text-gray-500">
                    Appointments today
                </p>

                <p class="mt-2 text-4xl font-semibold tracking-tight text-gray-900">
                    {{ $todayAppointments }}
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
                <p class="text-sm font-medium text-gray-500">
                    Pending follow-ups
                </p>

                <p class="mt-2 text-4xl font-semibold tracking-tight text-gray-900">
                    {{ $followUps }}
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
                <p class="text-sm font-medium text-gray-500">
                    Recent activity
                </p>

                <p class="mt-2 text-4xl font-semibold tracking-tight text-gray-900">
                    {{ $recentActivity->count() }}
                </p>
            </div>

        </div>

        <div id="today-appointments"
            class="mt-8 grid gap-6 lg:grid-cols-3">

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60 lg:col-span-2">

                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Today's appointments
                    </h2>

                    <span class="text-sm text-gray-500">
                        {{ $appointmentsTodayList->count() }} scheduled
                    </span>
                </div>

                {{-- Appointments Today List --}}
                <div class="mt-6 space-y-4">
                    @forelse($appointmentsTodayList as $appointment)
                        <div
                            class="flex items-center justify-between rounded-lg border border-gray-100 p-4">
                            <div>
                                <p class="font-medium text-gray-900">
                                    {{ $appointment->patient->full_name }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ str($appointment->visit_type->value)
                                        ->replace('_', ' ')
                                        ->title() }}
                                </p>
                            </div>

                            <div class="text-right">
                                <p
                                    class="font-medium text-blue-600">
                                    {{ $appointment->starts_at->format('H:i') }}
                                </p>
                                @if($appointment->assignedDoctor)
                                    <p class="text-sm text-gray-500">
                                        {{ $appointment->assignedDoctor->name }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div
                            class="rounded-lg border border-dashed p-8 text-center">
                            <p class="text-sm text-gray-500">
                                No appointments scheduled today.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Recent Activity --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
                <h2 class="text-lg font-semibold text-slate-900">
                    Recent activity
                </h2>

                <div class="mt-5 space-y-5">
                    @forelse($recentActivity as $activity)

                        <div class="relative pl-6">
                            <div
                                @class([
                                    'absolute left-0 top-1 h-3 w-3 rounded-full',

                                    'bg-blue-500'
                                        => $activity->visibility->isOperational(),

                                    'bg-emerald-500'
                                        => $activity->visibility->isClinical(),

                                    'bg-amber-500'
                                        => $activity->visibility->isPrivate(),

                                    'bg-slate-400'
                                        => $activity->visibility->isSystem(),
                                ])
                            ></div>

                            <p class="text-sm font-semibold text-slate-900">
                                {{ str($activity->event->value)->replace('_', ' ')->title() }}
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                {{ $activity->actor?->name ?? 'System' }}
                                ·
                                {{ $activity->created_at->diffForHumans() }}
                            </p>
                        </div>

                    @empty
                        <p class="text-sm text-slate-500">
                            No recent activity yet.
                        </p>
                    @endforelse
                </div>
            </div>

            {{--  Patients Follow Up --}}
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <h2 class="text-lg font-semibold text-slate-900">
                            Patients requiring follow-up
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Patients waiting for next clinical action.
                        </p>

                    </div>

                    <span
                        class="rounded-full bg-violet-100 px-3 py-1 text-sm font-medium text-purple-700"
                    >
            {{ $patientsFollowUp->count() }}
        </span>

                </div>

                <div class="mt-6 divide-y divide-slate-100">

                    @forelse($patientsFollowUp as $patient)

                        <a
                            href="{{ route('patients.show', $patient) }}"
                            class="flex items-center justify-between py-4 transition hover:bg-slate-50"
                        >

                            <div>

                                <p class="font-medium text-slate-900">
                                    {{ $patient->full_name }}
                                </p>

                                <p class="mt-1 text-sm text-purple-600">
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

                            <p class="text-sm text-slate-500">
                                No follow ups pending.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

            {{-- Patients Needing Attention --}}
            <div id="patients-attention"
                class="rounded-2xl lg:col-span-2 border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">

                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">
                            Patients needing attention
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Patients currently waiting or requiring follow-up.
                        </p>
                    </div>

                    <span class="text-sm text-slate-500">
                        {{ $patientsNeedingAttention->count() }} patients
                    </span>
                </div>

                <div class="mt-6 divide-y divide-slate-100">
                    @forelse($patientsNeedingAttention as $patient)
                        <a href="{{ route('patients.show', $patient) }}"
                           class="flex items-center justify-between gap-4 py-4 transition hover:bg-slate-50">

                            <div>
                                <p class="font-medium text-slate-900">
                                    {{ $patient->full_name }}
                                </p>

                                <div class="mt-2">
                        <span @class([
                            'inline-flex rounded-full px-2.5 py-1 text-xs font-medium',
                            'bg-amber-100 text-amber-700' => $patient->status === PatientStatus::Waiting,
                            'bg-blue-100 text-blue-700' => $patient->status === PatientStatus::Active,
                            'bg-emerald-100 text-emerald-700' => $patient->status === PatientStatus::InTreatment,
                            'bg-purple-100 text-purple-700' => $patient->status === PatientStatus::FollowUp,
                            'bg-slate-100 text-slate-700' => $patient->status === PatientStatus::Inactive,
                            'bg-zinc-100 text-zinc-700' => $patient->status === PatientStatus::Discharged,
                        ])>
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
                        <div class="rounded-lg border border-dashed border-slate-200 p-8 text-center">
                            <p class="text-sm text-slate-500">
                                No patients need attention right now.
                            </p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</div>
