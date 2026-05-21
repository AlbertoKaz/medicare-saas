<div class="max-w-5xl mx-auto px-4 py-8">

    <div
        class="mb-8 rounded-xl border p-6"
    >

        <div
            class="flex justify-between items-start"
        >

            <div>

                <h1
                    class="text-3xl font-bold"
                >
                    {{ $patient->full_name }}
                </h1>

                <p
                    class="text-sm text-gray-500"
                >
                    {{ $patient->status->value }}
                </p>

            </div>

            <a
                href="{{ route(
                    'patients.appointments.create',
                    $patient
                ) }}"
                class="rounded-lg bg-blue-600
                       px-4 py-2
                       text-white"
            >
                Schedule appointment
            </a>

        </div>

    </div>

    <div
        class="grid lg:grid-cols-3 gap-8"
    >

        <div
            class="lg:col-span-2"
        >

            <div
                class="rounded-xl border p-6"
            >

                <h2
                    class="mb-6 text-lg font-semibold"
                >
                    Timeline
                </h2>

                <div
                    class="space-y-4"
                >

                    @foreach(
                        $patient->activityLogs
                            ->sortByDesc('created_at')
                        as $activity
                    )

                        <div
                            class="border-l-2
                                   pl-4"
                        >

                            <div
                                class="font-medium"
                            >
                                {{ str(
                                    $activity->event->value
                                )->headline() }}
                            </div>

                            <div
                                class="text-sm
                                       text-gray-500"
                            >
                                {{ $activity->actor?->name }}

                                ·

                                {{ $activity
                                    ->created_at
                                    ->diffForHumans()
                                }}
                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

        <div>

            <div
                class="rounded-xl border p-6"
            >

                <h2
                    class="mb-4 font-semibold"
                >
                    Appointments
                </h2>

                <div
                    class="space-y-3"
                >

                    @foreach(
                        $patient->appointments
                    as $appointment)

                        <div
                            class="rounded-lg
                                   border
                                   p-3"
                        >

                            <div>

                                {{ $appointment
                                    ->visit_type
                                    ->value }}

                            </div>

                            <div
                                class="text-sm
                                       text-gray-500"
                            >

                                {{ $appointment
                                    ->starts_at
                                    ->format(
                                        'd/m/Y H:i'
                                    ) }}

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</div>
