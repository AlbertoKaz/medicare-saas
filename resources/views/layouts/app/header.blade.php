<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-slate-50 text-slate-900">

<flux:header container class="border-b border-slate-200 bg-white">
    <flux:sidebar.toggle class="mr-2 lg:hidden" icon="bars-2" inset="left" />

    {{-- Brand --}}
    <a
        href="{{ route('dashboard') }}"
        wire:navigate
        class="flex items-center gap-3"
    >
        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-600 text-white shadow-sm">
            <i class="fa-solid fa-staff-snake text-sm"></i>
        </div>

        <div class="hidden sm:block">
            <p class="text-sm font-bold leading-4 text-slate-950">
                MediCare
            </p>
            <p class="text-xs text-slate-500">
                Clinical workspace
            </p>
        </div>
    </a>

    {{-- Desktop nav --}}
    <flux:navbar class="-mb-px ml-8 max-lg:hidden">
        <flux:navbar.item
            icon="layout-grid"
            :href="route('dashboard')"
            :current="request()->routeIs('dashboard')"
            wire:navigate
        >
            Dashboard
        </flux:navbar.item>

        <flux:navbar.item
            icon="users"
            :href="route('patients.index')"
            :current="request()->routeIs('patients.*')"
            wire:navigate
        >
            Patients
        </flux:navbar.item>
    </flux:navbar>

    <flux:spacer />

    {{-- Current clinic --}}
    @if(currentClinic())
        <div class="mr-3 hidden items-center gap-2 rounded-full bg-slate-100 px-3 py-1.5 text-sm font-medium text-slate-700 md:inline-flex">
            <i class="fa-solid fa-hospital text-slate-400"></i>
            {{ currentClinic()->name }}
        </div>
    @endif

    <x-desktop-user-menu />
</flux:header>

{{-- Mobile Menu --}}
<flux:sidebar collapsible="mobile" sticky class="border-e border-slate-200 bg-white lg:hidden">
    <flux:sidebar.header>
        <a
            href="{{ route('dashboard') }}"
            wire:navigate
            class="flex items-center gap-3"
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

        <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
    </flux:sidebar.header>

    <flux:sidebar.nav>
        <flux:sidebar.group heading="Platform">
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
                :current="request()->routeIs('patients.*')"
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

    <flux:spacer />

    @if(currentClinic())
        <div class="mx-4 mb-4 rounded-2xl bg-slate-50 p-4">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                Current clinic
            </p>

            <p class="mt-1 text-sm font-semibold text-slate-900">
                {{ currentClinic()->name }}
            </p>
        </div>
    @endif
</flux:sidebar>

{{ $slot }}

@persist('toast')
<flux:toast.group>
    <flux:toast />
</flux:toast.group>
@endpersist

@fluxScripts
</body>
</html>
