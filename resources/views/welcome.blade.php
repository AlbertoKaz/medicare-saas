<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MediCare</title>

    <link rel="icon" href="/favicon.ico">

    <link
        rel="preconnect"
        href="https://cdnjs.cloudflare.com"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body
    class="
min-h-screen
bg-linear-to-b

from-slate-50
via-blue-50/40
to-white

dark:from-slate-950
dark:via-slate-900
dark:to-slate-950

text-slate-900
dark:text-white
flex
flex-col
"
>

<header
    class="
w-full
max-w-7xl
mx-auto
px-6
py-6
"
>

    @if(Route::has('login'))

        <nav class="flex justify-end">

            @auth

                <a
                    href="{{ route('dashboard') }}"
                    class="
                    rounded-xl
                    border
                    border-slate-200
                    bg-white/80
                    backdrop-blur
                    px-5
                    py-2
                    text-sm
                    font-medium
                    shadow-sm
                    hover:shadow-md
                    transition
                    "
                >
                    Dashboard
                </a>

            @else

                <a
                    href="{{ route('login') }}"
                    class="
                    rounded-xl
                    border
                    border-slate-200

                    bg-white/80
                    dark:bg-slate-900/80

                    backdrop-blur

                    px-5
                    py-2

                    text-sm
                    font-medium

                    shadow-sm

                    hover:bg-white
                    hover:shadow-md

                    transition
                    "
                >
                    Staff login
                </a>

            @endauth

        </nav>

    @endif

</header>

<main
    class="
flex-1
flex
items-center
justify-center
px-6
pb-20
"
>

    <div
        class="
max-w-7xl
w-full

grid
lg:grid-cols-2

gap-16
items-center
"
    >

        {{-- LEFT --}}

        <div
            class="
    max-w-2xl
    "
        >

        <span
            class="
        inline-flex

        rounded-full

        bg-blue-100
        dark:bg-blue-950

        px-4
        py-1

        text-sm
        font-medium

        text-blue-700
        dark:text-blue-300
        "
        >
            MEDICARE SAAS
        </span>

            <h1
                class="
        mt-6

        text-5xl
        lg:text-6xl

        font-bold

        tracking-tight

        leading-tight
        "
            >

                Modern clinic operations.

                <span
                    class="
            text-blue-600
            "
                >
                Built for healthcare teams.
            </span>

            </h1>

            <p
                class="
        mt-8

        text-lg

        text-slate-600
        dark:text-slate-400

        leading-relaxed

        max-w-xl
        "
            >

                Multi-tenant clinical workspace
                designed for healthcare professionals.

                Appointments, patient management,
                clinical notes and staff collaboration
                inside a secure environment.

            </p>

            <div
                class="
        mt-10

        flex
        flex-wrap

        gap-3
        "
            >

                <div
                    class="
            rounded-xl

            border

            bg-white/80
            dark:bg-slate-900/80

            px-4
            py-3

            shadow-sm
            "
                >
                    Patient records
                </div>

                <div
                    class="
            rounded-xl

            border

            bg-white/80
            dark:bg-slate-900/80

            px-4
            py-3

            shadow-sm
            "
                >
                    Clinical notes
                </div>

                <div
                    class="
            rounded-xl

            border

            bg-white/80
            dark:bg-slate-900/80

            px-4
            py-3

            shadow-sm
            "
                >
                    Appointments
                </div>

                <div
                    class="
            rounded-xl

            border

            bg-white/80
            dark:bg-slate-900/80

            px-4
            py-3

            shadow-sm
            "
                >
                    Multi clinic
                </div>

            </div>

        </div>

        {{-- RIGHT --}}
        {{-- RIGHT --}}

        <div
            class="
flex
justify-center
lg:justify-end
"
        >

            <div
                class="
    w-full
    max-w-md

    rounded-3xl

    border
    border-slate-200

    bg-white/90
    backdrop-blur

    p-8

    shadow-xl
    shadow-blue-100/40
    "
            >

                <div class="text-center">

                    <div
                        class="
            mx-auto

            flex
            h-14
            w-14

            items-center
            justify-center

            rounded-2xl

            bg-blue-600

            text-white
            shadow-sm
            "
                    >
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>

                    <h2
                        class="
            mt-5
            text-2xl
            font-bold
            "
                    >
                        Clinical workspace
                    </h2>

                    <p
                        class="
            mt-3
            text-slate-600
            "
                    >
                        Secure access for doctors,
                        assistants and clinic staff.
                    </p>

                </div>

                <div class="mt-8 space-y-3">

                    <div
                        class="
            rounded-xl
            bg-slate-50
            p-4
            "
                    >
                        ✓ Patient management
                    </div>

                    <div
                        class="
            rounded-xl
            bg-slate-50
            p-4
            "
                    >
                        ✓ Clinical notes
                    </div>

                    <div
                        class="
            rounded-xl
            bg-slate-50
            p-4
            "
                    >
                        ✓ Appointment workflows
                    </div>

                </div>

                <a
                    href="{{ route('login') }}"
                    class="
            mt-8

            flex
            w-full

            items-center
            justify-center

            rounded-2xl

            bg-blue-600

            px-5
            py-3

            font-semibold
            text-white

            shadow-sm

            hover:bg-blue-700

            transition
            "
                >
                    Staff login
                </a>

            </div>

        </div>

    </div>
</main>
</body>

</html>
