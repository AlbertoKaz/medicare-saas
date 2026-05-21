<div class="max-w-3xl mx-auto px-4 py-8">

    <div class="mb-8">

        <h1 class="text-2xl font-bold">
            Schedule appointment
        </h1>

        <p class="text-sm text-gray-500 dark:text-gray-400">

            {{ $patient->full_name }}

        </p>

    </div>

    @if (session('success'))

        <div
            class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700
                   dark:border-green-800 dark:bg-green-900/20 dark:text-green-300"
        >
            {{ session('success') }}

        </div>

    @endif

    <form
        wire:submit="save"
        class="space-y-6"
    >

        <div>

            <label
                class="mb-2 block text-sm font-medium"
            >
                Visit type
            </label>

            <select
                wire:model="visit_type"
                class="w-full rounded-lg border-gray-300
                       dark:border-gray-700
                       dark:bg-gray-900"
            >

                <option value="">
                    Select type
                </option>

                @foreach($appointmentTypes as $type)

                    <option
                        value="{{ $type->value }}"
                    >
                        {{ str($type->name)->headline() }}
                    </option>

                @endforeach

            </select>

            @error('visit_type')

            <p class="mt-1 text-sm text-red-500">

                {{ $message }}

            </p>

            @enderror

        </div>

        <div>

            <label
                class="mb-2 block text-sm font-medium"
            >
                Date and time
            </label>

            <input
                wire:model="starts_at"
                type="datetime-local"
                class="w-full rounded-lg border-gray-300
                       dark:border-gray-700
                       dark:bg-gray-900"
            >

            @error('starts_at')

            <p class="mt-1 text-sm text-red-500">

                {{ $message }}

            </p>

            @enderror

        </div>

        <div>

            <label
                class="mb-2 block text-sm font-medium"
            >
                Operational notes
            </label>

            <textarea
                wire:model="notes_operational"
                rows="4"
                class="w-full rounded-lg border-gray-300
                       dark:border-gray-700
                       dark:bg-gray-900"
            ></textarea>

            @error('notes_operational')

            <p class="mt-1 text-sm text-red-500">

                {{ $message }}

            </p>

            @enderror

        </div>

        <div
            class="flex gap-3"
        >

            <button
                type="submit"
                class="rounded-lg bg-blue-600
                       px-4 py-2
                       text-white
                       hover:bg-blue-700"
            >
                Schedule appointment
            </button>

            <a
                href="{{ route('patients.show', $patient) }}"
                class="rounded-lg border
                       px-4 py-2"
            >
                Cancel
            </a>

        </div>

    </form>

</div>
