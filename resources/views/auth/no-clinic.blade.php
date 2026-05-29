<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>No clinic assigned</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >
</head>

<body class="min-h-screen bg-slate-50">

<div class="flex min-h-screen items-center justify-center px-6">

    <div class="w-full max-w-xl rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-sm shadow-slate-200/60">

        {{-- Icon --}}
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-600 text-white shadow-lg shadow-blue-600/20">
            <i class="fa-solid fa-hospital-user text-xl"></i>
        </div>

        {{-- Brand --}}
        <h2 class="mt-5 text-3xl font-bold text-slate-950">
            MediCare
        </h2>

        <p class="mt-1 text-sm font-medium text-slate-500">
            Clinical workspace
        </p>

        {{-- Message --}}
        <h1 class="mt-8 text-4xl font-bold tracking-tight text-slate-950">
            No clinic assigned
        </h1>

        <p class="mt-6 text-base leading-8 text-slate-600">
            Your account has been created successfully,
            but it is not currently assigned to any clinic.
        </p>

        <p class="mt-2 text-base leading-8 text-slate-600">
            Please contact your clinic administrator
            to request access.
        </p>

        {{-- Logout --}}
        <form
            method="POST"
            action="{{ route('logout') }}"
            class="mt-10"
        >
            @csrf

            <button
                type="submit"
                class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
            >
                <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>

                Log out
            </button>
        </form>

    </div>

</div>

</body>
</html>
