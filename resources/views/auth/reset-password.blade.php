@extends('layouts.auth')

@section('title', 'Resetowanie hasła')

@section('hero_title', 'Ustaw nowe hasło')
@section('hero_subtitle', 'Wprowadź nowe hasło dla swojego konta.')

@section('content')
<div class="space-y-8">
    <div class="md:hidden text-center mb-8">
        <span class="text-indigo-600 dark:text-indigo-400 font-semibold tracking-wider text-sm uppercase">Laravel DDD</span>
    </div>

    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Resetowanie hasła</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Wprowadź nowe hasło i potwierdź je</p>
    </div>

    @if (session('status'))
        <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-900/50 text-emerald-700 dark:text-emerald-300 text-sm">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 rounded-xl bg-red-50 dark:bg-red-950/50 border border-red-200 dark:border-red-900/50 text-red-700 dark:text-red-300 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Adres e-mail</label>
            <input type="email" name="email" id="email" value="{{ old('email', $email) }}" required autofocus autocomplete="username"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-shadow">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nowe hasło</label>
            <input type="password" name="password" id="password" required autocomplete="new-password"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-shadow">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Potwierdź hasło</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-shadow">
        </div>

        <button type="submit" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900 transition-all duration-200">
            Zresetuj hasło
        </button>
    </form>

    <p class="text-center text-sm text-slate-600 dark:text-slate-400">
        <a href="{{ route('login') }}" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 transition-colors">
            ← Powrót do logowania
        </a>
    </p>
</div>
@endsection
