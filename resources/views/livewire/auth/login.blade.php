<x-layouts::auth :title="__('Log in')">
    <div
        class="
            flex flex-col gap-5

            [&_input]:h-12!
            [&_input]:rounded-2xl!
            [&_input]:border!
            [&_input]:border-slate-300!
            [&_input]:bg-white!
            [&_input]:px-4!
            [&_input]:text-slate-900!
            [&_input]:shadow-sm!
            [&_input]:outline-none!

            [&_input:focus]:border-blue-500!
            [&_input:focus]:ring-0!
            [&_input:focus]:outline-none!
            [&_input:focus]:shadow-[0_0_0_3px_rgba(59,130,246,0.15)]!

            [&_label]:text-sm!
            [&_label]:font-semibold!
            [&_label]:text-slate-700!

            [&_input[type='checkbox']]:h-5!
            [&_input[type='checkbox']]:w-5!
            [&_input[type='checkbox']]:rounded-md!
            [&_input[type='checkbox']]:border!
            [&_input[type='checkbox']]:border-slate-300!
            [&_input[type='checkbox']]:bg-white!
            [&_input[type='checkbox']:checked]:bg-blue-600!

            [&_button[type='submit']]:rounded-xl!
            [&_button[type='submit']]:bg-blue-600!
            [&_button[type='submit']]:text-white!
            [&_button[type='submit']]:shadow-sm!
            [&_button[type='submit']:hover]:bg-blue-700!
        "
    >

        {{-- Brand header --}}
        <div class="text-center">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 text-white shadow-sm shadow-blue-200">
                <i class="fa-solid fa-user-doctor text-lg"></i>
            </div>

            <p class="mt-5 text-sm font-semibold text-blue-600">
                MediCare
            </p>

            <h1 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">
                Sign in to your clinic workspace
            </h1>

            <p class="mt-3 text-sm leading-6 text-slate-500">
                Access your private clinical environment using your staff credentials.
            </p>
        </div>

        {{-- Private access notice --}}
        <div class="rounded-2xl border border-blue-100 bg-blue-50/60 p-4">
            <div class="flex gap-3">
                <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                    <i class="fa-solid fa-lock text-sm"></i>
                </div>

                <div>
                    <p class="text-sm font-semibold text-slate-900">
                        Staff access only
                    </p>

                    <p class="mt-1 text-sm text-slate-600">
                        Accounts are managed by clinic administrators. Public registration is disabled.
                    </p>
                </div>
            </div>
        </div>

        {{-- Session Status --}}
        <x-auth-session-status class="text-center" :status="session('status')" />

        {{-- Passkey --}}
        <div
            class="
        [&_button]:rounded-2xl!
        [&_button]:border!
        [&_button]:border-slate-200!
        [&_button]:bg-slate-50!
        [&_button]:text-slate-600!
        [&_button]:shadow-sm!

        [&_button:hover]:bg-blue-50!
        [&_button:hover]:text-blue-600!

        [&_button_*]:bg-transparent!
        [&_button:hover_*]:bg-transparent!

        [&_hr]:border-slate-200!

        [&_div:not(:has(button))_span]:bg-white!
        [&_div:not(:has(button))_span]:px-3!
        [&_div:not(:has(button))_span]:text-xs!
        [&_div:not(:has(button))_span]:font-semibold!
        [&_div:not(:has(button))_span]:uppercase!
        [&_div:not(:has(button))_span]:tracking-wide!
        [&_div:not(:has(button))_span]:text-slate-400!
    "
        >
            <x-passkey-verify />
        </div>


        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-4">
            @csrf

            <div>
                <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">
                    Email address
                </label>

                <input
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    type="email"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="doctor@clinic.test"
                    class="block h-12 w-full rounded-2xl border border-slate-300 bg-white px-4 text-sm text-slate-900 shadow-sm outline-none placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                >
            </div>


            {{-- Password --}}
            <div>
                <div class="mb-2 flex items-center justify-between">

                    <label
                        for="password"
                        class="block text-sm font-semibold text-slate-700"
                    >
                        Password
                    </label>

                    @if (Route::has('password.request'))
                        <a
                            href="{{ route('password.request') }}"
                            wire:navigate
                            class="text-sm font-medium text-blue-600 hover:text-blue-700"
                        >
                            Forgot your password?
                        </a>
                    @endif

                </div>

                <div
                    x-data="{ showPassword: false }"
                    class="relative"
                >

                    <input
                        id="password"
                        name="password"
                        :type="showPassword ? 'text' : 'password'"
                        required
                        autocomplete="current-password"
                        placeholder="Password"

                        class="
                block
                h-12
                w-full
                rounded-2xl
                border
                border-slate-300
                bg-white
                px-4
                pe-12
                text-sm
                text-slate-900
                shadow-sm
                outline-none

                placeholder:text-slate-400

                focus:border-blue-500
                focus:ring-4
                focus:ring-blue-100
            "
                    >

                    <button
                        type="button"

                        @click="showPassword = !showPassword"

                        class="
                absolute
                inset-y-0
                end-4
                flex
                items-center

                text-slate-400
                hover:text-blue-600

                transition-colors
            "
                    >

                        <i
                            x-show="!showPassword"
                            class="fa-regular fa-eye"
                        ></i>

                        <i
                            x-show="showPassword"
                            x-cloak
                            class="fa-regular fa-eye-slash"
                        ></i>

                    </button>

                </div>

            </div>

            <div class="pt-1">
                <flux:checkbox
                    name="remember"
                    :label="__('Remember this device')"
                    :checked="old('remember')"
                />
            </div>

            <flux:button
                variant="primary"
                type="submit"
                class="w-full"
                data-test="login-button"
            >
                <span class="inline-flex items-center justify-center gap-2">
                    <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                    Sign in
                </span>
            </flux:button>
        </form>

        <p class="text-center text-sm text-slate-500">
            Need access? Contact your clinic administrator.
        </p>
    </div>
</x-layouts::auth>
