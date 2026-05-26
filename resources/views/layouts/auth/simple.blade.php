<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
<div class="flex min-h-svh flex-col items-center justify-center bg-gradient-to-b from-slate-50 via-white to-blue-50/50 p-6 md:p-10">

    <div class="w-full max-w-md">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/70 sm:p-8">
            {{ $slot }}
        </div>
    </div>

</div>

@persist('toast')
<flux:toast.group>
    <flux:toast />
</flux:toast.group>
@endpersist

@fluxScripts
</body>
</html>
