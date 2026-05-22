<div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">
            Clinical dashboard
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Today’s operational overview for {{ currentClinic()->name }}.
        </p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-gray-500">
                Active patients
            </p>

            <p class="mt-2 text-3xl font-semibold text-gray-900">
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

        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900">
                Recent activity
            </h2>

            <div class="mt-4 space-y-4">
                @forelse($recentActivity as $activity)
                    <div class="border-l-2 border-blue-200 pl-4">
                        <p class="text-sm font-medium text-gray-900">
                            {{ str($activity->event_type->value)->replace('_', ' ')->title() }}
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

    </div>

</div>
