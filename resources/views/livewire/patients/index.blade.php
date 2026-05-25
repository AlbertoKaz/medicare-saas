<div class="min-h-screen bg-slate-50">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
            <a
                href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-slate-700"
            >
                <i class="fa-solid fa-arrow-left text-xs"></i>
                Back to dashboard
            </a>

            <div class="mt-6 flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <p class="text-sm font-semibold text-blue-600">
                        Patient management
                    </p>

                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-950">
                        Patients
                    </h1>

                    <p class="mt-3 text-sm text-slate-500">
                        Browse patient records for
                        <span class="font-semibold text-slate-900">
                            {{ currentClinic()->name }}
                        </span>
                    </p>
                </div>

                <a
                    href="{{ route('patients.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                >
                    <i class="fa-solid fa-user-plus text-xs"></i>
                    New patient
                </a>
            </div>
        </div>

        {{-- Patients list --}}
        <div class="rounded-3xl border border-slate-200 bg-white shadow-sm shadow-slate-200/60">

            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
                <div>
                    <p class="text-sm font-semibold text-slate-900">
                        Patient records
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $patients->count() }} patients registered
                    </p>
                </div>

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>

            <div class="divide-y divide-slate-100">
                @forelse($patients as $patient)
                    <a
                        href="{{ route('patients.show', $patient) }}"
                        class="group flex flex-col gap-4 px-6 py-5 transition hover:bg-blue-50/30 sm:flex-row sm:items-center sm:justify-between"
                    >
                        <div class="flex items-start gap-4">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-500 group-hover:bg-blue-100 group-hover:text-blue-600">
                                <i class="fa-solid fa-user"></i>
                            </div>

                            <div>
                                <p class="font-semibold text-slate-950 group-hover:text-blue-700">
                                    {{ $patient->full_name }}
                                </p>

                                <div class="mt-2 flex flex-wrap items-center gap-2">
                                    <span
                                        @class([
                                            'inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium',

                                            'bg-amber-100 text-amber-700'
                                                => $patient->status === $patientStatus::Waiting,

                                            'bg-blue-100 text-blue-700'
                                                => $patient->status === $patientStatus::Active,

                                            'bg-emerald-100 text-emerald-700'
                                                => $patient->status === $patientStatus::InTreatment,

                                            'bg-violet-100 text-violet-700'
                                                => $patient->status === $patientStatus::FollowUp,

                                            'bg-slate-100 text-slate-700'
                                                => $patient->status === $patientStatus::Inactive,

                                            'bg-zinc-100 text-zinc-700'
                                                => $patient->status === $patientStatus::Discharged,
                                        ])
                                    >
                                        <i class="fa-solid fa-circle text-[6px]"></i>
                                        {{ str($patient->status->value)->replace('_', ' ')->title() }}
                                    </span>

                                    @if($patient->assignedDoctor)
                                        <span class="inline-flex items-center gap-1.5 text-sm text-slate-500">
                                            <i class="fa-solid fa-user-doctor text-xs text-slate-400"></i>
                                            Assigned to {{ $patient->assignedDoctor->name }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 text-sm text-slate-400">
                                            <i class="fa-solid fa-user-doctor text-xs"></i>
                                            No doctor assigned
                                        </span>
                                    @endif
                                </div>
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
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                            <i class="fa-solid fa-users"></i>
                        </div>

                        <p class="mt-4 text-sm font-medium text-slate-900">
                            No patients yet.
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            Create the first patient record for this clinic.
                        </p>

                        <a
                            href="{{ route('patients.create') }}"
                            class="mt-5 inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                        >
                            <i class="fa-solid fa-user-plus text-xs"></i>
                            Create patient
                        </a>
                    </div>
                @endforelse
            </div>

        </div>

    </div>
</div>

