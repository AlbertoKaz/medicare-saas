@php
    use App\Enums\PatientStatus;
@endphp

<div class="min-h-screen bg-slate-50">

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                Clinic overview
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Today’s operational overview for {{ currentClinic()->name }}.
            </p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
                <p class="text-sm font-medium text-gray-500">
                    Active patients
                </p>

                <p class="mt-2 text-4xl font-semibold tracking-tight text-slate-900">
                    {{ $activePatients }}
                </p>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-gray-500">
                    Appointments today
                </p>

                <p class="mt-2 text-3xl font-semibold text-gray-900">
                    {{ $todayAppointments }}
                </p>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-gray-500">
                    Pending follow-ups
                </p>

                <p class="mt-2 text-3xl font-semibold text-gray-900">
                    {{ $followUps }}
                </p>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-gray-500">
                    Recent activity
                </p>

                <p class="mt-2 text-3xl font-semibold text-gray-900">
                    {{ $recentActivity->count() }}
                </p>
            </div>

        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-3">

            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm lg:col-span-2">

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
            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-gray-900">
                    Recent activity
                </h2>

                <div class="mt-4 space-y-4">
                    @forelse($recentActivity as $activity)
                        {{-- Icons --}}
                        @php
                            $icon = match($activity->event) {
                                'patient_created' => 'P',
                                'appointment_scheduled' => 'A',
                                'patient_status_changed' => 'S',
                                'clinical_note_added' => 'N',
                                default => '·',
                            };
                        @endphp

                        <div
                            @class([
                                'border-l-2 pl-4',
                                'border-blue-300'
                                    => $activity->visibility->isOperational(),
                                'border-emerald-300'
                                    => $activity->visibility->isClinical(),
                                'border-amber-300'
                                    => $activity->visibility->isPrivate(),
                                'border-zinc-300'
                                    => $activity->visibility->isSystem(),
                            ])
                        >
                            <p class="text-sm font-medium text-gray-900">
                                {{ str($activity->event->value)->replace('_', ' ')->title() }}
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ $activity->created_at->diffForHumans() }}
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">
                            No recent activity yet.
                        </p>
                    @endforelse
                </div>
            </div>

            {{-- Patients Needing Attention --}}
            <div class="mt-8 rounded-2xl lg:col-span-2 border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">

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
