<x-layouts::auth :title="__('Confirm password')">
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
            [&_input]:outline-none!

            [&_input:focus]:border-blue-500!
            [&_input:focus]:ring-0!
            [&_input:focus]:shadow-[0_0_0_3px_rgba(59,130,246,0.15)]!

            [&_button[type='submit']]:rounded-2xl!
            [&_button[type='submit']]:bg-blue-600!
            [&_button[type='submit']]:text-white!
            [&_button[type='submit']]:shadow-sm!
            [&_button[type='submit']:hover]:bg-blue-700!
        "
    >
        <div class="text-center">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-600 text-white shadow-lg shadow-blue-600/20">
                <i class="fa-solid fa-shield-halved text-lg"></i>
            </div>

            <p class="mt-5 text-sm font-semibold text-blue-600">
                MediCare
            </p>

            <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-950">
                Confirm secure access
            </h1>

            <p class="mt-3 text-sm leading-6 text-slate-500">
                Please confirm your password before continuing to this secure area.
            </p>
        </div>

        <x-auth-session-status class="text-center" :status="session('status')" />

        <div
            class="
                [&_button]:rounded-2xl!
                [&_button]:border!
                [&_button]:border-slate-200!
                [&_button]:bg-slate-50!
                [&_button]:text-slate-700!
                [&_button]:shadow-sm!
                [&_button:hover]:bg-blue-50!
                [&_button:hover]:text-blue-600!

                [&_.relative_span]:bg-white!
            "
        >
            <x-passkey-verify
                options-route="passkey.confirm-options"
                submit-route="passkey.confirm"
                :label="__('Confirm with passkey')"
                :loading-label="__('Confirming...')"
                :separator="__('Or confirm with password')"
            />
        </div>

        <form method="POST" action="{{ route('password.confirm.store') }}" class="flex flex-col gap-5">
            @csrf

            <flux:input
                name="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('Password')"
                viewable
            />

            <flux:button
                variant="primary"
                type="submit"
                class="w-full"
                data-test="confirm-password-button"
            >
                Confirm
            </flux:button>
        </form>
    </div>
</x-layouts::auth>
