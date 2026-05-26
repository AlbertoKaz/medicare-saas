<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-slate-50 text-slate-900">

<flux:sidebar
    sticky
    collapsible="mobile"
    class="
        border-e border-slate-200
        bg-white
        text-slate-700

        **:data-flux-sidebar-item:text-slate-700

        [&_[data-flux-sidebar-item]:hover]:text-blue-600
        [&_[data-flux-sidebar-item]:hover]:bg-blue-50

        **:data-flux-sidebar-group-heading:text-slate-400

        **:data-current:text-blue-600
        **:data-current:font-semibold
        **:data-current:bg-blue-50
    "
>
    <flux:sidebar.header>
        {{-- Brand --}}
        <a
            href="{{ route('dashboard') }}"
            wire:navigate
            class="flex items-center gap-3 px-1"
        >
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-600 text-white shadow-sm">
                <i class="fa-solid fa-staff-snake text-sm"></i>
            </div>

            <div>
                <p class="text-sm font-bold leading-4 text-slate-950">
                    MediCare
                </p>

                <p class="text-xs text-slate-500">
                    Clinical workspace
                </p>
            </div>
        </a>

        <flux:sidebar.collapse class="lg:hidden" />
    </flux:sidebar.header>

    <flux:sidebar.nav>
        <flux:sidebar.group
            heading="Platform"
            class="grid">
            <flux:sidebar.item
                icon="layout-grid"
                :href="route('dashboard')"
                :current="request()->routeIs('dashboard')"
                wire:navigate
            >
                Dashboard
            </flux:sidebar.item>

            <flux:sidebar.item
                icon="users"
                :href="route('patients.index')"
                :current="request()->routeIs('patients.index') || request()->routeIs('patients.show')"
                wire:navigate
            >
                Patients
            </flux:sidebar.item>

            <flux:sidebar.item
                icon="user-plus"
                :href="route('patients.create')"
                :current="request()->routeIs('patients.create')"
                wire:navigate
            >
                New patient
            </flux:sidebar.item>
        </flux:sidebar.group>
    </flux:sidebar.nav>

    <flux:sidebar.nav>
        <flux:sidebar.group
            heading="Operations"
            class="grid">
            <flux:sidebar.item
                icon="calendar-days"
                href="#"
            >
                Appointments
            </flux:sidebar.item>

            <flux:sidebar.item
                icon="bolt"
                href="#"
            >
                Activity
            </flux:sidebar.item>
        </flux:sidebar.group>
    </flux:sidebar.nav>

    <flux:spacer />

    @if(currentClinic())
        <div class="mx-3 mb-4 rounded-2xl border border-slate-200 bg-slate-50 p-4">
            <div class="flex items-start gap-3">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <i class="fa-solid fa-hospital text-sm"></i>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Current clinic
                    </p>

                    <p class="mt-1 text-sm font-semibold leading-5 text-slate-900">
                        {{ currentClinic()->name }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
</flux:sidebar>

{{-- Mobile Header --}}
<flux:header class="border-b border-slate-200 bg-white lg:hidden">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

    <div class="flex items-center gap-2">
        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-600 text-white">
            <i class="fa-solid fa-staff-snake text-xs"></i>
        </div>

        <span class="text-sm font-bold text-slate-950">
                MediCare
            </span>
    </div>

    <flux:spacer />

    <flux:dropdown position="top" align="end">
        <flux:profile
            :initials="auth()->user()->initials()"
            icon-trailing="chevron-down"
        />

        <flux:menu>
            <flux:menu.radio.group>
                <div class="p-0 text-sm font-normal">
                    <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                        <flux:avatar
                            :name="auth()->user()->name"
                            :initials="auth()->user()->initials()"
                        />

                        <div class="grid flex-1 text-start text-sm leading-tight">
                            <flux:heading class="truncate">
                                {{ auth()->user()->name }}
                            </flux:heading>

                            <flux:text class="truncate">
                                {{ auth()->user()->email }}
                            </flux:text>
                        </div>
                    </div>
                </div>
            </flux:menu.radio.group>

            <flux:menu.separator />

            <flux:menu.radio.group>
                <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                    Settings
                </flux:menu.item>
            </flux:menu.radio.group>

            <flux:menu.separator />

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf

                <flux:menu.item
                    as="button"
                    type="submit"
                    icon="arrow-right-start-on-rectangle"
                    class="w-full cursor-pointer"
                    data-test="logout-button"
                >
                    Log out
                </flux:menu.item>
            </form>
        </flux:menu>
    </flux:dropdown>
</flux:header>

{{ $slot }}

@persist('toast')
<flux:toast.group>
    <flux:toast />
</flux:toast.group>
@endpersist

@fluxScripts
</body>
</html>
