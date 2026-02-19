@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-2xl w-full mx-auto">
    <h1 class="text-2xl font-semibold mb-6 text-[#1b1b18] dark:text-[#EDEDEC]">Dashboard</h1>

    <p class="text-[#706f6c] dark:text-[#A1A09A] mb-6">
        Witaj, <strong class="text-[#1b1b18] dark:text-[#EDEDEC]">{{ auth()->user()->name }}</strong>!
    </p>

    <div class="flex gap-3 mb-6">
        <a href="{{ route('profile.edit') }}" class="inline-block px-4 py-2 border border-[#19140035] dark:border-[#3E3E3A] text-[#1b1b18] dark:text-[#EDEDEC] font-medium rounded-lg hover:bg-[#19140035] dark:hover:bg-[#3E3E3A] transition-colors">
            Edytuj profil
        </a>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="px-4 py-2 border border-[#19140035] dark:border-[#3E3E3A] text-[#1b1b18] dark:text-[#EDEDEC] font-medium rounded-lg hover:bg-[#19140035] dark:hover:bg-[#3E3E3A] transition-colors">
            Wyloguj się
        </button>
    </form>
</div>
@endsection
