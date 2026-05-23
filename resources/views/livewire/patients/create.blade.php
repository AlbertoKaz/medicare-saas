<!--suppress HtmlUnknownAttribute -->
<div class="min-h-screen bg-slate-50">
    <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">

        <div class="mb-8">

            <p class="text-sm font-semibold text-blue-600">
                Patient management
            </p>

            <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-950">
                Create patient
            </h1>

            <p class="mt-3 text-base text-slate-600">
                Register a new patient within the current clinic workspace.
            </p>

        </div>

        @if (session('success'))

            <div
                class="mb-6 rounded-xl border
                       border-emerald-200
                       bg-emerald-50
                       px-4 py-3
                       text-sm font-medium
                       text-emerald-700"
            >
                {{ session('success') }}

            </div>

        @endif

        <form
            wire:submit="save"
            class="rounded-2xl border
                   border-slate-200
                   bg-white
                   p-6
                   shadow-sm
                   sm:p-7"
        >

            <div
                class="grid gap-5
                       sm:grid-cols-2"
            >

                <div>

                    <label
                        class="mb-2 block text-sm
                               font-semibold
                               text-slate-700"
                    >
                        First name
                    </label>

                    <input
                        type="text"
                        wire:model="first_name"
                        placeholder="Laura"
                        class="block w-full
                               rounded-xl
                               border border-slate-300
                               bg-white
                               px-4 py-3
                               text-sm
                               shadow-sm
                               focus:border-blue-500
                               focus:ring-blue-500"
                    >

                    @error('first_name')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                    @enderror

                </div>

                <div>

                    <label
                        class="mb-2 block text-sm
                               font-semibold
                               text-slate-700"
                    >
                        Last name
                    </label>

                    <input
                        type="text"
                        wire:model="last_name"
                        placeholder="Gómez"
                        class="block w-full
                               rounded-xl
                               border border-slate-300
                               bg-white
                               px-4 py-3
                               text-sm
                               shadow-sm
                               focus:border-blue-500
                               focus:ring-blue-500"
                    >

                    @error('last_name')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                    @enderror

                </div>

                <div>

                    <label
                        class="mb-2 block text-sm
                               font-semibold
                               text-slate-700"
                    >
                        Email
                    </label>

                    <input
                        type="email"
                        wire:model="email"
                        placeholder="patient@example.com"
                        class="block w-full
                               rounded-xl
                               border border-slate-300
                               bg-white
                               px-4 py-3
                               text-sm
                               shadow-sm
                               focus:border-blue-500
                               focus:ring-blue-500"
                    >

                    @error('email')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                    @enderror

                </div>

                <div>

                    <label
                        class="mb-2 block text-sm
                               font-semibold
                               text-slate-700"
                    >
                        Phone
                    </label>

                    <input
                        type="text"
                        wire:model="phone"
                        placeholder="+34 600 000 000"
                        class="block w-full
                               rounded-xl
                               border border-slate-300
                               bg-white
                               px-4 py-3
                               text-sm
                               shadow-sm
                               focus:border-blue-500
                               focus:ring-blue-500"
                    >

                    @error('phone')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                    @enderror

                </div>

                <div
                    class="sm:col-span-2"
                >

                    <label
                        class="mb-2 block text-sm
                               font-semibold
                               text-slate-700"
                    >
                        Birth date
                    </label>

                    <input
                        type="date"
                        wire:model="birth_date"
                        class="block w-full
                               rounded-xl
                               border border-slate-300
                               bg-white
                               px-4 py-3
                               text-sm
                               shadow-sm
                               focus:border-blue-500
                               focus:ring-blue-500"
                    >

                    @error('birth_date')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                    @enderror

                </div>

                <div
                    class="sm:col-span-2"
                >

                    <label
                        class="mb-2 block text-sm
                               font-semibold
                               text-slate-700"
                    >
                        Operational notes
                    </label>

                    <textarea
                        wire:model="notes"
                        rows="3"
                        placeholder="Optional operational information..."
                        class="block w-full
                               rounded-xl
                               border border-slate-300
                               bg-white
                               px-4 py-3
                               text-sm
                               shadow-sm
                               focus:border-blue-500
                               focus:ring-blue-500"
                    ></textarea>

                    @error('notes')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                    @enderror

                </div>

            </div>

            <div
                class="mt-8 flex
                       justify-end
                       border-t
                       border-slate-200
                       pt-6"
            >

                <button
                    type="submit"
                    class="rounded-xl
                           bg-blue-600
                           px-5 py-2.5
                           text-sm
                           font-semibold
                           text-white
                           shadow-sm
                           hover:bg-blue-700"
                >
                    Create patient
                </button>

            </div>

        </form>

    </div>
</div>
