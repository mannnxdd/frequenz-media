<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">
                Selamat Datang, {{ Auth::user()->name }}!
            </h1>

            @if(Auth::user()->hasRole('admin'))
                <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 underline">Buka Dashboard Admin</a>
            @elseif(Auth::user()->hasRole('designer'))
                <a href="{{ route('orders.desain') }}" class="text-indigo-600 underline">Lihat Pesanan Desain</a>
            @elseif(Auth::user()->hasRole('fotografer'))
                <a href="{{ route('orders.foto') }}" class="text-indigo-600 underline">Lihat Pesanan Foto</a>
            @elseif(Auth::user()->hasRole('social-media'))
                <a href="{{ route('projects.publish') }}" class="text-indigo-600 underline">Kelola Proyek Publikasi</a>
            @endif
        </div>
    </div>
</x-app-layout>
