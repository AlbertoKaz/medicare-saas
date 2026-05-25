<div class="min-h-screen bg-slate-50">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">

        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <a href="{{ route('dashboard') }}"
               class="text-sm font-medium text-slate-500 hover:text-slate-700"
            >
                ← Back to dashboard
            </a>

            <div class="mt-4">
                <p class="text-sm font-semibold text-blue-600">
                    Patient management
                </p>

                <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-950">
                    Patients
                </h1>

                <p class="mt-3 text-base text-slate-600">
                    Browse patient records for
                    {{ currentClinic()->name }}.
                </p>

            </div>
        </div>

            <a
                href="{{ route('patients.create') }}"
                class="inline-flex justify-center rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700"
            >
                New patient
            </a>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-4">
                <p class="text-sm font-medium text-slate-500">
                    {{ $patients->count() }} patients
                </p>
            </div>

            <div class="divide-y divide-slate-100">
                @forelse($patients as $patient)
                    <a
                        href="{{ route('patients.show', $patient) }}"
                        class="flex flex-col gap-4 px-6 py-5 transition hover:bg-slate-50 sm:flex-row sm:items-center sm:justify-between"
                    >
                        <div>
                            <p class="font-semibold text-slate-900">
                                {{ $patient->full_name }}
                            </p>

                            <div class="mt-2 flex flex-wrap items-center gap-2">
                                <span
                                    @class([
                                        'inline-flex rounded-full px-2.5 py-1 text-xs font-medium',
                                        'bg-amber-100 text-amber-700' => $patient->status === $patientStatus::Waiting,
                                        'bg-blue-100 text-blue-700' => $patient->status === $patientStatus::Active,
                                        'bg-emerald-100 text-emerald-700' => $patient->status === $patientStatus::InTreatment,
                                        'bg-violet-100 text-violet-700' => $patient->status === $patientStatus::FollowUp,
                                        'bg-slate-100 text-slate-700' => $patient->status === $patientStatus::Inactive,
                                        'bg-zinc-100 text-zinc-700' => $patient->status === $patientStatus::Discharged,
                                    ])
                                >
                                    {{ str($patient->status->value)->replace('_', ' ')->title() }}
                                </span>

                                @if($patient->assignedDoctor)
                                    <span class="text-sm text-slate-500">
                                        Assigned to {{ $patient->assignedDoctor->name }}
                                    </span>
                                @else
                                    <span class="text-sm text-slate-400">
                                        No doctor assigned
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="text-sm text-slate-500 sm:text-right">
                            <p>Updated</p>
                            <p class="font-medium text-slate-700">
                                {{ $patient->updated_at->diffForHumans() }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="px-6 py-12 text-center">
                        <p class="text-sm font-medium text-slate-900">
                            No patients yet.
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            Create the first patient record for this clinic.
                        </p>

                        <a
                            href="{{ route('patients.create') }}"
                            class="mt-5 inline-flex justify-center rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700"
                        >
                            Create patient
                        </a>
                    </div>
                @endforelse
            </div>

        </div>

    </div>
</div>
