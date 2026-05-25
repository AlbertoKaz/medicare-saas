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
                        Clinical workspace
                    </p>

                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-950">
                        Add clinical note
                    </h1>

                    <p class="mt-3 text-sm text-slate-500">
                        Add a private clinical note for
                        <span class="font-semibold text-slate-900">
                            {{ $patient->full_name }}
                        </span>
                    </p>
                </div>

                <div class="inline-flex w-fit items-center gap-2 rounded-full bg-emerald-50 px-4 py-2 text-sm font-semibold text-emerald-700">
                    <i class="fa-solid fa-lock text-xs"></i>
                    Clinical access
                </div>
            </div>
        </div>

        {{-- Form --}}
        <form
            wire:submit="save"
            class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60 sm:p-7"
        >
            <div class="mb-6 rounded-2xl border border-blue-100 bg-blue-50/60 p-4">
                <div class="flex gap-3">
                    <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                        <i class="fa-solid fa-notes-medical"></i>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-slate-900">
                            Sensitive clinical information
                        </p>

                        <p class="mt-1 text-sm text-slate-600">
                            This note will only be visible to authorized clinical roles.
                        </p>
                    </div>
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Note content
                </label>

                <textarea
                    wire:model="content"
                    rows="9"
                    placeholder="Write clinical observations, treatment context or relevant medical notes..."
                    class="block w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-blue-500"
                ></textarea>

                <p class="mt-2 flex items-center gap-2 text-xs text-slate-500">
                    <i class="fa-solid fa-shield-halved text-slate-400"></i>
                    This content is protected by clinical permissions.
                </p>

                @error('content')
                <p class="mt-2 text-sm font-medium text-red-600">
                    {{ $message }}
                </p>
                @enderror
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
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    Save note
                </button>
            </div>
        </form>

    </div>
</div>
