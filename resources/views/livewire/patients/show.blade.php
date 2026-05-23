@php use App\Enums\PatientStatus; @endphp
<div class="min-h-screen bg-slate-50">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-start sm:justify-between">

                <div>
                    <p class="text-sm font-semibold text-blue-600">
                        Patient workspace
                    </p>

                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-950">
                        {{ $patient->full_name }}
                    </h1>

                    <div class="mt-3 flex flex-wrap items-center gap-3">
                        <span class="inline-flex rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 ring-1 ring-inset ring-blue-200">
                            {{ str($patient->status->name)->headline() }}
                        </span>

                        @if($patient->assignedDoctor)
                            <span class="text-sm text-slate-500">
                                Assigned to {{ $patient->assignedDoctor->name }}
                            </span>
                        @endif
                    </div>
                </div>

                <a
                    href="{{ route('patients.appointments.create', $patient) }}"
                    class="inline-flex justify-center rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700"
                >
                    Schedule appointment
                </a>

            </div>
        </div>

        {{-- Status --}}
        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <label class="mb-2 block text-sm font-semibold text-slate-700">
                Patient status
            </label>

            <select
                wire:change="changeStatus($event.target.value)"
                class="block w-full max-w-xs rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:ring-blue-500"
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

        <div class="grid gap-8 lg:grid-cols-3">

            {{-- Main column --}}
            <div class="space-y-8 lg:col-span-2">

                {{-- Timeline --}}
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-slate-950">
                            Timeline
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Recent operational and clinical activity.
                        </p>
                    </div>

                    <div class="space-y-5">
                        @forelse($this->visibleActivities() as $activity)
                            <div class="relative border-l-2 border-slate-200 pl-5">
                                <div class="absolute -left-[5px] top-1 h-2.5 w-2.5 rounded-full bg-blue-600"></div>

                                <div class="text-sm font-semibold text-slate-900">
                                    {{ str($activity->event->value)->headline() }}
                                </div>

                                <div class="mt-1 text-sm text-slate-500">
                                    {{ $activity->actor?->name ?? 'System' }}
                                    ·
                                    {{ $activity->created_at->diffForHumans() }}
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500">
                                No activity yet.
                            </p>
                        @endforelse
                    </div>
                </section>

                {{-- Clinical Notes --}}
                @if($canViewClinicalNotes)
                    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="mb-6 flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-lg font-semibold text-slate-950">
                                    Clinical Notes
                                </h2>

                                <p class="mt-1 text-sm text-slate-500">
                                    Sensitive clinical information visible only to authorized roles.
                                </p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            @forelse(
                                $patient->clinicalNotes->sortByDesc('created_at')
                                as $note
                            )
                                <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                                    <div class="mb-2 text-sm text-slate-500">
                                        {{ $note->author?->name }}
                                        ·
                                        {{ $note->created_at->diffForHumans() }}
                                    </div>

                                    <div class="whitespace-pre-line text-sm leading-6 text-slate-800">
                                        {{ $note->content }}
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-slate-500">
                                    No clinical notes yet.
                                </p>
                            @endforelse
                        </div>
                    </section>
                @endif

            </div>

            {{-- Sidebar --}}
            <aside class="space-y-8">

                {{-- Appointments --}}
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="mb-5">
                        <h2 class="text-lg font-semibold text-slate-950">
                            Appointments
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Scheduled visits and operational appointments.
                        </p>
                    </div>

                    <div class="space-y-3">
                        @forelse($patient->appointments as $appointment)
                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                                <div class="text-sm font-semibold text-slate-900">
                                    {{ str($appointment->visit_type->value)->headline() }}
                                </div>

                                <div class="mt-1 text-sm text-slate-500">
                                    {{ $appointment->starts_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500">
                                No appointments yet.
                            </p>
                        @endforelse
                    </div>
                </section>

            </aside>

        </div>

    </div>
</div>
