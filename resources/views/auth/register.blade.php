@extends('layouts.auth')

@section('title', 'Rejestracja')

@section('hero_title', 'Dołącz do nas')
@section('hero_subtitle', 'Utwórz konto, aby rozpocząć korzystanie z aplikacji.')

@section('content')
<div class="space-y-8">
    <div class="md:hidden text-center mb-8">
        <span class="text-indigo-600 dark:text-indigo-400 font-semibold tracking-wider text-sm uppercase">Laravel DDD</span>
    </div>

    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Rejestracja</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Wypełnij formularz, aby utworzyć konto</p>
    </div>

    @if ($errors->any())
        <div class="p-4 rounded-xl bg-red-50 dark:bg-red-950/50 border border-red-200 dark:border-red-900/50 text-red-700 dark:text-red-300 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Imię</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-shadow">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Adres e-mail</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="username"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-shadow">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Hasło</label>
            <input type="password" name="password" id="password" required autocomplete="new-password"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-shadow">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Potwierdź hasło</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-shadow">
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="remember" id="remember"
                class="h-4 w-4 rounded border-slate-300 dark:border-slate-600 text-indigo-600 focus:ring-indigo-500">
            <label for="remember" class="ml-3 text-sm text-slate-600 dark:text-slate-400">Zapamiętaj mnie</label>
        </div>

        <button type="submit" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900 transition-all duration-200">
            Zarejestruj się
        </button>
    </form>

    <p class="text-center text-sm text-slate-600 dark:text-slate-400">
        Masz już konto?
        <a href="{{ route('login') }}" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 transition-colors">
            Zaloguj się
        </a>
    </p>
</div>
@endsection
