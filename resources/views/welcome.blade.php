<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MediCare</title>

    <link rel="icon" href="/favicon.ico">

    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col bg-linear-to-b from-slate-50 via-blue-50/40 to-white text-slate-900 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 dark:text-white">

<header class="mx-auto w-full max-w-7xl px-6 py-6">
    @if(Route::has('login'))
        <nav class="flex justify-end">
            @auth
                <a
                    href="{{ route('dashboard') }}"
                    class="rounded-xl border border-slate-200 bg-white/80 px-5 py-2 text-sm font-medium shadow-sm backdrop-blur transition hover:shadow-md"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="rounded-xl border border-slate-200 bg-white/80 px-5 py-2 text-sm font-medium shadow-sm backdrop-blur transition hover:bg-white hover:shadow-md dark:bg-slate-900/80"
                >
                    Staff login
                </a>
            @endauth
        </nav>
    @endif
</header>

<main class="flex flex-1 items-center justify-center px-6 pb-20">
    <div class="grid w-full max-w-7xl items-center gap-16 lg:grid-cols-2">

        {{-- Left --}}
        <div class="max-w-2xl">
            <span class="inline-flex rounded-full bg-blue-100 px-4 py-1 text-sm font-medium text-blue-700 dark:bg-blue-950 dark:text-blue-300">
                MEDICARE SAAS
            </span>

            <h1 class="mt-6 text-5xl font-bold leading-tight tracking-tight lg:text-6xl">
                Modern clinic operations.

                <span class="text-blue-600">
                    Built for healthcare teams.
                </span>
            </h1>

            <p class="mt-8 max-w-xl text-lg leading-relaxed text-slate-600 dark:text-slate-400">
                Multi-tenant clinical workspace designed for healthcare professionals.
                Appointments, patient management, clinical notes and staff collaboration
                inside a secure environment.
            </p>

            <div class="mt-10 flex flex-wrap gap-3">
                <div class="rounded-xl border bg-white/80 px-4 py-3 shadow-sm dark:bg-slate-900/80">
                    Patient records
                </div>

                <div class="rounded-xl border bg-white/80 px-4 py-3 shadow-sm dark:bg-slate-900/80">
                    Clinical notes
                </div>

                <div class="rounded-xl border bg-white/80 px-4 py-3 shadow-sm dark:bg-slate-900/80">
                    Appointments
                </div>

                <div class="rounded-xl border bg-white/80 px-4 py-3 shadow-sm dark:bg-slate-900/80">
                    Multi clinic
                </div>
            </div>
        </div>

        {{-- Right --}}
        <div class="flex justify-center lg:justify-end">
            <div class="w-full max-w-md rounded-3xl border border-slate-200 bg-white/90 p-8 shadow-xl shadow-blue-100/40 backdrop-blur">

                <div class="text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-600 text-white shadow-sm">
                        <i class="fa-solid fa-xl fa-hospital-user"></i>
                    </div>

                    <h2 class="mt-5 text-2xl font-bold">
                        Clinical workspace
                    </h2>

                    <p class="mt-3 text-slate-600">
                        Secure access for doctors, assistants and clinic staff.
                    </p>
                </div>

                <div class="mt-8 space-y-3">
                    <div class="rounded-xl bg-slate-50 p-4">
                        ✓ Patient management
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4">
                        ✓ Clinical notes
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4">
                        ✓ Appointment workflows
                    </div>
                </div>

                <a
                    href="{{ route('login') }}"
                    class="mt-8 flex w-full items-center justify-center rounded-2xl bg-blue-600 px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-blue-700"
                >
                    Staff login
                </a>
            </div>
        </div>

    </div>
</main>

</body>
</html>
