@extends('layouts.app')

@section('title', 'Resetowanie hasła')

@section('content')
<div class="max-w-md w-full mx-auto">
    <h1 class="text-2xl font-semibold mb-6 text-[#1b1b18] dark:text-[#EDEDEC]">Resetowanie hasła</h1>

    @if (session('status'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 text-sm">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-4 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label for="email" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">Adres e-mail</label>
            <input type="email" name="email" id="email" value="{{ old('email', $email) }}" required autofocus autocomplete="username"
                class="w-full px-4 py-2 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-[#F53003] focus:border-transparent">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">Nowe hasło</label>
            <input type="password" name="password" id="password" required autocomplete="new-password"
                class="w-full px-4 py-2 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-[#F53003] focus:border-transparent">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">Potwierdź hasło</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                class="w-full px-4 py-2 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-[#F53003] focus:border-transparent">
        </div>

        <button type="submit" class="w-full px-4 py-2 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] font-medium rounded-lg hover:opacity-90 transition-opacity">
            Zresetuj hasło
        </button>
    </form>

    <p class="mt-4 text-sm text-[#706f6c] dark:text-[#A1A09A]">
        <a href="{{ route('login') }}" class="font-medium text-[#F53003] dark:text-[#FF4433] hover:underline">← Powrót do logowania</a>
    </p>
</div>
@endsection
