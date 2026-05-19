{{-- resources/views/superadmin/layout.blade.php --}}
@extends('layouts.app')

@section('content')

@php
    $adminUser = Auth::user();
    $adminName = $adminUser?->name ?? 'Superadmin';
    $adminInitials = str($adminName)->explode(' ')->filter()->map(fn ($part) => str($part)->substr(0, 1))->take(2)->join('');
@endphp

<div class="flex min-h-screen bg-[#F5F6FA]" x-data="{ sidebarOpen: false }">
    <div x-show="sidebarOpen" class="fixed inset-0 z-50 bg-black/50 md:hidden" @click="sidebarOpen = false" style="display: none;"></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-[#1565C0]/15 flex flex-col transition-transform duration-300 md:relative md:translate-x-0 md:flex shadow-sm">
        <div class="p-6 border-b border-[#1565C0]/10 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <img src="{{ asset('images/logo.png') }}" alt="G-RPL" class="h-8 w-auto">
                <span class="font-heading font-bold text-[#1565C0] text-xl">G-RPL</span>
            </div>
            <button @click="sidebarOpen = false" class="md:hidden text-gray-500 hover:text-gray-700 transition-colors">x</button>
        </div>

        <nav class="flex-grow p-4 space-y-1.5">
            @foreach([
                ['route' => 'dashboard.superadmin', 'label' => 'Dashboard'],
                ['route' => 'superadmin.staff', 'label' => 'Staff'],
                ['route' => 'superadmin.managers', 'label' => 'Manager'],
                ['route' => 'superadmin.asesors', 'label' => 'Asesor'],
            ] as $item)
                <a href="{{ route($item['route']) }}" class="flex items-center gap-3 px-4 py-3 rounded-lg font-bold text-sm transition-colors {{ Route::is($item['route']) ? 'bg-[#E3F0FF] text-[#1565C0]' : 'text-[#5A6478] hover:bg-gray-50' }}">
                    <span class="w-2 h-2 rounded-full bg-current"></span>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="p-4 border-t border-[#1565C0]/10">
            <div class="bg-[#F5F6FA] p-3 rounded-lg flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-[#1565C0] text-white flex items-center justify-center font-bold text-xs flex-shrink-0">{{ $adminInitials ?: 'SA' }}</div>
                <div class="overflow-hidden">
                    <p class="text-xs font-bold text-[#1A1A2E] truncate">{{ $adminName }}</p>
                    <p class="text-[10px] text-[#5A6478] truncate">Superadmin</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="w-full px-4 py-2 text-[#D32F2F] hover:bg-red-50 rounded-lg transition-colors text-xs font-bold">Logout</button>
            </form>
        </div>
    </aside>

    <main class="flex-grow flex flex-col min-w-0">
        <header class="bg-white border-b border-[#1565C0]/15 h-16 px-4 md:px-8 flex items-center justify-between sticky top-0 z-40">
            <div class="flex items-center gap-2 sm:gap-4 min-w-0">
                <button @click="sidebarOpen = true" class="md:hidden p-2 text-gray-500 hover:text-[#1565C0] transition-colors flex-shrink-0">Menu</button>
                <h1 class="font-heading font-bold text-[#1A1A2E] text-base sm:text-lg truncate">@yield('page_title')</h1>
            </div>
            <span class="hidden sm:block text-[10px] font-bold px-2 py-1 bg-green-100 text-green-700 rounded-full uppercase">Online</span>
        </header>

        <div class="p-4 md:p-8">
            @yield('superadmin_content')
        </div>
    </main>
</div>

@endsection
