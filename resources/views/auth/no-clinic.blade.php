
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>No clinic assigned</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

<div class="min-h-screen flex items-center justify-center px-6">

    <div class="max-w-md w-full rounded-2xl border border-slate-200 bg-white p-8 shadow-sm text-center">

        <h1 class="text-2xl font-bold text-slate-900">
            No clinic assigned
        </h1>

        <p class="mt-4 text-sm text-slate-600">
            Your account exists but is not assigned
            to any clinic.

            Please contact your clinic administrator.
        </p>

        <form
            method="POST"
            action="{{ route('logout') }}"
            class="mt-6"
        >
            @csrf
            <button type="submit"
                    class="w-full rounded-lg bg-slate-900 px-4 py-2 text-white hover:bg-slate-800"
            >
                Log out
            </button>
        </form>
    </div>
</div>

</body>
</html>
