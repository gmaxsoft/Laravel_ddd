@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 p-6 lg:p-8">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Dashboard</h1>

        <p class="mt-4 text-slate-600 dark:text-slate-400">
            Witaj, <strong class="text-slate-900 dark:text-white">{{ auth()->user()->name }}</strong>!
        </p>

        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-lg shadow-indigo-500/25 transition-all duration-200">
                Edytuj profil
            </a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-medium rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                    Wyloguj się
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
