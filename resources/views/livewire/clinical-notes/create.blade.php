<div class="min-h-screen bg-slate-50">
    <div class="mx-auto max-w-2xl px-4 py-10 sm:px-6 lg:px-8">

        <div class="mb-8">
            <a
                href="{{ route('patients.show', $patient) }}"
                class="text-sm font-medium text-slate-500 hover:text-slate-700"
            >
                ← Back to patient
            </a>

            <p class="mt-6 text-sm font-semibold text-blue-600">
                Clinical note
            </p>

            <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-950">
                Add clinical note
            </h1>

            <p class="mt-3 text-base text-slate-600">
                Add a private clinical note for
                <span class="font-semibold text-slate-900">
                    {{ $patient->full_name }}
                </span>
            </p>
        </div>

        <form
            wire:submit="save"
            class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-7"
        >
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Note content
                </label>

                <textarea
                    wire:model="content"
                    rows="8"
                    placeholder="Write clinical observations, treatment context or relevant medical notes..."
                    class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                ></textarea>

                <p class="mt-2 text-xs text-slate-500">
                    This content is clinical and only visible to authorized clinical roles.
                </p>

                @error('content')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="mt-7 flex flex-col-reverse gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-end">
                <a
                    href="{{ route('patients.show', $patient) }}"
                    class="inline-flex justify-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="inline-flex justify-center rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700"
                >
                    Save note
                </button>
            </div>
        </form>

    </div>
</div>
