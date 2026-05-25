<div class="min-h-screen bg-slate-50">
    <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
            <a
                href="{{ route('patients.show', $patient) }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-slate-700"
            >
                <i class="fa-solid fa-arrow-left text-xs"></i>
                Back to patient
            </a>

            <div class="mt-6 flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <p class="text-sm font-semibold text-blue-600">
                        Appointment scheduling
                    </p>

                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-950">
                        Schedule appointment
                    </h1>

                    <p class="mt-3 text-sm text-slate-500">
                        Create an operational appointment for
                        <span class="font-semibold text-slate-900">
                            {{ $patient->full_name }}
                        </span>
                    </p>
                </div>

                <div class="inline-flex w-fit items-center gap-2 rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700">
                    <i class="fa-solid fa-calendar-check text-xs"></i>
                    Operational workflow
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                <i class="fa-solid fa-circle-check mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- Form --}}
        <form
            wire:submit="save"
            class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60 sm:p-7"
        >
            <div class="mb-6 rounded-2xl border border-blue-100 bg-blue-50/60 p-4">
                <div class="flex gap-3">
                    <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                        <i class="fa-solid fa-calendar-plus"></i>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-slate-900">
                            Operational appointment
                        </p>

                        <p class="mt-1 text-sm text-slate-600">
                            Use this form for scheduling, logistics and non-clinical appointment context.
                        </p>
                    </div>
                </div>
            </div>

            <div class="space-y-5">

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Visit type
                    </label>

                    <div class="relative">
                        <select
                            wire:model="visit_type"
                            class="block w-full h-10 rounded-2xl border border-slate-300 bg-white px-4 py-3 pr-10 text-sm text-slate-900 shadow-sm transition focus:border-blue-500 focus:ring-blue-500"
                        >
                            <option value="">Select type</option>

                            @foreach($appointmentTypes as $type)
                                <option value="{{ $type->value }}">
                                    {{ str($type->name)->headline() }}
                                </option>
                            @endforeach
                        </select>

                        <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>

                    @error('visit_type')
                    <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Date and time
                    </label>

                    <div class="relative">
                        <input
                            wire:model="starts_at"
                            type="datetime-local"
                            class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm transition focus:border-blue-500 focus:ring-blue-500"
                        >

                        <div class="pointer-events-none absolute inset-y-0 right-4 hidden items-center text-slate-400 sm:flex">
                            <i class="fa-solid fa-clock text-xs"></i>
                        </div>
                    </div>

                    @error('starts_at')
                    <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Operational notes
                    </label>

                    <textarea
                        wire:model="notes_operational"
                        rows="4"
                        placeholder="Add scheduling context, logistics, room notes or non-clinical details..."
                        class="block w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-blue-500"
                    ></textarea>

                    <p class="mt-2 flex items-center gap-2 text-xs text-slate-500">
                        <i class="fa-solid fa-circle-info text-slate-400"></i>
                        Do not include sensitive clinical observations here.
                    </p>

                    @error('notes_operational')
                    <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="mt-7 flex flex-col-reverse gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-end">
                <a
                    href="{{ route('patients.show', $patient) }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                >
                    <i class="fa-solid fa-calendar-plus text-xs"></i>
                    Schedule appointment
                </button>
            </div>
        </form>

    </div>
</div>
