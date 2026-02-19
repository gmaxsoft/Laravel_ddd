<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen font-sans antialiased">
        <div class="min-h-screen flex flex-col md:flex-row">
            {{-- Left: Gradient branding panel --}}
            <div class="hidden md:flex md:w-1/2 lg:w-3/5 bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 p-12 lg:p-20 flex-col justify-between">
                <div>
                    <span class="text-indigo-400 font-semibold tracking-wider text-sm uppercase">Laravel DDD</span>
                    <h2 class="mt-8 text-4xl lg:text-5xl font-bold text-white leading-tight">
                        @yield('hero_title', 'Witaj ponownie')
                    </h2>
                    <p class="mt-4 text-lg text-slate-400 max-w-md">
                        @yield('hero_subtitle', 'Zaloguj się, aby kontynuować.')
                    </p>
                </div>
                <div class="flex gap-2 mt-8">
                    <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                    <div class="w-2 h-2 rounded-full bg-indigo-500/50"></div>
                    <div class="w-2 h-2 rounded-full bg-indigo-500/30"></div>
                </div>
            </div>

            {{-- Right: Form panel --}}
            <div class="flex-1 flex items-center justify-center p-6 lg:p-12 bg-slate-50 dark:bg-slate-950">
                <div class="w-full max-w-md">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>
