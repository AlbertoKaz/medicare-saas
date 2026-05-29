<div class="grid gap-8 lg:grid-cols-[240px_minmax(0,1fr)]">

    {{-- Settings navigation --}}
    <aside class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm shadow-slate-200/60">
        <nav aria-label="{{ __('Settings') }}" class="space-y-2">
            <a
                href="{{ route('profile.edit') }}"
                wire:navigate
                @class([
                    'flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition',
                    'bg-blue-50 text-blue-700' => request()->routeIs('profile.edit'),
                    'text-slate-600 hover:bg-slate-50 hover:text-slate-950' => ! request()->routeIs('profile.edit'),
                ])
            >
                <i class="fa-solid fa-user text-xs"></i>
                {{ __('Profile') }}
            </a>

            <a
                href="{{ route('security.edit') }}"
                wire:navigate
                @class([
                    'flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition',
                    'bg-blue-50 text-blue-700' => request()->routeIs('security.edit'),
                    'text-slate-600 hover:bg-slate-50 hover:text-slate-950' => ! request()->routeIs('security.edit'),
                ])
            >
                <i class="fa-solid fa-shield-halved text-xs"></i>
                {{ __('Security') }}
            </a>

            <a
                href="{{ route('appearance.edit') }}"
                wire:navigate
                @class([
                    'flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition',
                    'bg-blue-50 text-blue-700' => request()->routeIs('appearance.edit'),
                    'text-slate-600 hover:bg-slate-50 hover:text-slate-950' => ! request()->routeIs('appearance.edit'),
                ])
            >
                <i class="fa-solid fa-palette text-xs"></i>
                {{ __('Appearance') }}
            </a>
        </nav>
    </aside>

    {{-- Settings content --}}
    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
        <div class="border-b border-slate-100 pb-5">
            <h2 class="text-xl font-bold tracking-tight text-slate-950">
                {{ $heading ?? '' }}
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                {{ $subheading ?? '' }}
            </p>
        </div>

        <div
            class="
                mt-6 w-full max-w-2xl

                [&_label]:text-sm!
                [&_label]:font-semibold!
                [&_label]:text-slate-700!

                [&_input]:h-11!
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
                [&_button[type='submit']]:px-5!
                [&_button[type='submit']]:py-2.5!
                [&_button[type='submit']]:text-sm!
                [&_button[type='submit']]:font-semibold!
                [&_button[type='submit']]:text-white!
                [&_button[type='submit']]:shadow-sm!
                [&_button[type='submit']:hover]:bg-blue-700!
            "
        >
            {{ $slot }}
        </div>
    </section>

</div>
