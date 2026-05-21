<div class="max-w-3xl mx-auto px-4 py-8">

    <h1
        class="mb-6 text-2xl font-bold"
    >
        Add clinical note
    </h1>

    <p
        class="mb-6 text-sm text-gray-500"
    >
        {{ $patient->full_name }}
    </p>

    <form
        wire:submit="save"
        class="space-y-6"
    >

        <div>

            <textarea
                wire:model="content"
                rows="10"
                class="w-full rounded-lg
                       border-gray-300
                       dark:border-gray-700
                       dark:bg-gray-900"
            ></textarea>

            @error('content')

            <p
                class="mt-1 text-sm text-red-500"
            >
                {{ $message }}
            </p>

            @enderror

        </div>

        <button
            type="submit"
            class="rounded-lg
                   bg-blue-600
                   px-4
                   py-2
                   text-white"
        >
            Save note
        </button>

    </form>

</div>
