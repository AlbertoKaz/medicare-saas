<x-layouts::auth :title="__('Log in')">
        <div
            class="
            flex flex-col gap-6

            [&_input]:h-12!
            [&_input]:rounded-2xl!
            [&_input]:border!
            [&_input]:border-slate-300!
            [&_input]:bg-white!
            [&_input]:px-4!
            [&_input]:text-slate-900!
            [&_input]:shadow-sm!
            [&_input::placeholder]:text-slate-400!
            [&_input:focus]:border-blue-500!
            [&_input:focus]:ring-blue-500!

            [&_label]:text-slate-700!

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
                <i class="fa-solid fa-staff-snake text-lg"></i>
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

        <div class="[&_button]:rounded-2xl! [&_button]:border! [&_button]:border-slate-200! [&_button]:bg-slate-50! [&_button]:text-slate-700! [&_button]:shadow-sm! [&_button:hover]:bg-blue-50! [&_button:hover]:text-blue-600!">
            <x-passkey-verify />
        </div>

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

            <flux:input
                name="email"
                :label="__('Email address')"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="doctor@clinic.test"
            />

            <div class="relative">
                <flux:input
                    name="password"
                    :label="__('Password')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Password')"
                    viewable
                />

                @if (Route::has('password.request'))
                    <flux:link
                        class="absolute top-0 text-sm inset-e-0"
                        :href="route('password.request')"
                        wire:navigate
                    >
                        {{ __('Forgot your password?') }}
                    </flux:link>
                @endif
            </div>

            <flux:checkbox
                name="remember"
                :label="__('Remember this device')"
                :checked="old('remember')"
            />

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
