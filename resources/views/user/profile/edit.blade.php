@extends('layouts.app')

@section('title', 'Edycja profilu')

@section('content')
<div class="max-w-md w-full mx-auto space-y-8">
    <h1 class="text-2xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Edycja profilu</h1>

    @if (session('status') === 'profile-updated')
        <div class="p-4 rounded-lg bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 text-sm">
            Dane profilu zostały zaktualizowane.
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="p-4 rounded-lg bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 text-sm">
            Hasło zostało zaktualizowane.
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Profile data form --}}
    <section>
        <h2 class="text-lg font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Dane profilu</h2>

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('patch')

            <div>
                <label for="name" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">Imię</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required autocomplete="name"
                    class="w-full px-4 py-2 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-[#F53003] focus:border-transparent">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">Adres e-mail</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                    class="w-full px-4 py-2 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-[#F53003] focus:border-transparent">
            </div>

            <button type="submit" class="px-4 py-2 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] font-medium rounded-lg hover:opacity-90 transition-opacity">
                Zapisz dane
            </button>
        </form>
    </section>

    {{-- Password form --}}
    <section>
        <h2 class="text-lg font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Zmiana hasła</h2>

        <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-4">
            @csrf
            @method('put')

            <div>
                <label for="current_password" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">Aktualne hasło</label>
                <input type="password" name="current_password" id="current_password" required autocomplete="current-password"
                    class="w-full px-4 py-2 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-[#F53003] focus:border-transparent">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">Nowe hasło</label>
                <input type="password" name="password" id="password" required autocomplete="new-password"
                    class="w-full px-4 py-2 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-[#F53003] focus:border-transparent">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">Potwierdź nowe hasło</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                    class="w-full px-4 py-2 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-[#F53003] focus:border-transparent">
            </div>

            <button type="submit" class="px-4 py-2 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] font-medium rounded-lg hover:opacity-90 transition-opacity">
                Zmień hasło
            </button>
        </form>
    </section>
</div>
@endsection
