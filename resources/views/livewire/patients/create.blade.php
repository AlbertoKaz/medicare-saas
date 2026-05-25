<!--suppress HtmlUnknownAttribute -->
<div class="min-h-screen bg-slate-50">
    <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
            <a
                href="{{ route('patients.index') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-slate-700"
            >
                <i class="fa-solid fa-arrow-left text-xs"></i>
                Back to patients
            </a>

            <div class="mt-6 flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <p class="text-sm font-semibold text-blue-600">
                        Patient management
                    </p>

                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-950">
                        Create patient
                    </h1>

                    <p class="mt-3 text-sm text-slate-500">
                        Register a new patient within
                        <span class="font-semibold text-slate-900">
                            {{ currentClinic()->name }}
                        </span>
                    </p>
                </div>

                <div class="inline-flex w-fit items-center gap-2 rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700">
                    <i class="fa-solid fa-user-plus text-xs"></i>
                    New patient
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
                        <i class="fa-solid fa-id-card"></i>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-slate-900">
                            Patient record
                        </p>

                        <p class="mt-1 text-sm text-slate-600">
                            This information belongs to the current clinic workspace.
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        First name
                    </label>

                    <input
                        type="text"
                        wire:model="first_name"
                        placeholder="Laura"
                        class="block h-12 w-full rounded-2xl border border-slate-300 bg-white px-4 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-blue-500"
                    >

                    @error('first_name')
                    <p class="mt-2 text-sm font-medium text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Last name
                    </label>

                    <input
                        type="text"
                        wire:model="last_name"
                        placeholder="Gómez"
                        class="block h-12 w-full rounded-2xl border border-slate-300 bg-white px-4 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-blue-500"
                    >

                    @error('last_name')
                    <p class="mt-2 text-sm font-medium text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Email
                    </label>

                    <input
                        type="email"
                        wire:model="email"
                        placeholder="patient@example.com"
                        class="block h-12 w-full rounded-2xl border border-slate-300 bg-white px-4 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-blue-500"
                    >

                    @error('email')
                    <p class="mt-2 text-sm font-medium text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Phone
                    </label>

                    <input
                        type="text"
                        wire:model="phone"
                        placeholder="+34 600 000 000"
                        class="block h-12 w-full rounded-2xl border border-slate-300 bg-white px-4 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-blue-500"
                    >

                    @error('phone')
                    <p class="mt-2 text-sm font-medium text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Birth date
                    </label>

                    <input
                        type="date"
                        wire:model="birth_date"
                        class="block h-12 w-full rounded-2xl border border-slate-300 bg-white px-4 text-sm text-slate-900 shadow-sm transition focus:border-blue-500 focus:ring-blue-500"
                    >

                    @error('birth_date')
                    <p class="mt-2 text-sm font-medium text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Operational notes
                    </label>

                    <textarea
                        wire:model="notes"
                        rows="4"
                        placeholder="Optional operational information..."
                        class="block w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-blue-500"
                    ></textarea>

                    <p class="mt-2 flex items-center gap-2 text-xs text-slate-500">
                        <i class="fa-solid fa-circle-info text-slate-400"></i>
                        Use this field for administrative or operational context, not clinical observations.
                    </p>

                    @error('notes')
                    <p class="mt-2 text-sm font-medium text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

            </div>

            <div class="mt-7 flex flex-col-reverse gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-end">
                <a
                    href="{{ route('patients.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                >
                    <i class="fa-solid fa-user-plus text-xs"></i>
                    Create patient
                </button>
            </div>
        </form>

    </div>
</div>
