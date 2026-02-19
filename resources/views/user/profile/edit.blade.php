@extends('layouts.app')

@section('title', 'Edycja profilu')

@section('content')
<div class="max-w-2xl space-y-8">
    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Edycja profilu</h1>

    @if (session('status') === 'profile-updated')
        <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-900/50 text-emerald-700 dark:text-emerald-300 text-sm">
            Dane profilu zostały zaktualizowane.
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-900/50 text-emerald-700 dark:text-emerald-300 text-sm">
            Hasło zostało zaktualizowane.
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

    {{-- Profile data form --}}
    <section class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 p-6 lg:p-8">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-6">Dane profilu</h2>

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
            @csrf
            @method('patch')

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Imię</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required autocomplete="name"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-shadow">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Adres e-mail</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-shadow">
            </div>

            <button type="submit" class="px-4 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-lg shadow-indigo-500/25 transition-all duration-200">
                Zapisz dane
            </button>
        </form>
    </section>

    {{-- Password form --}}
    <section class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 p-6 lg:p-8">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-6">Zmiana hasła</h2>

        <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-5">
            @csrf
            @method('put')

            <div>
                <label for="current_password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Aktualne hasło</label>
                <input type="password" name="current_password" id="current_password" required autocomplete="current-password"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-shadow">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nowe hasło</label>
                <input type="password" name="password" id="password" required autocomplete="new-password"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-shadow">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Potwierdź nowe hasło</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-shadow">
            </div>

            <button type="submit" class="px-4 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-lg shadow-indigo-500/25 transition-all duration-200">
                Zmień hasło
            </button>
        </form>
    </section>
</div>
@endsection
