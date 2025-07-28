<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto">

        <!-- 🔘 Tombol Navigasi -->
        <div class="mb-6 flex flex-wrap gap-4">
            <a href="{{ route('users.index') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md">
                👥 Kelola User
            </a>

            <a href="{{ route('orders.index') }}"
               class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md">
                📦 Kelola Pesanan
            </a>
            <a href="{{ route('projects.index') }}"
   class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md">
    🗂️ Kelola Proyek
</a>
        </div>

        <!-- 📊 Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Pesanan</h2>
                <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $orderCount }}</p>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Proyek</h2>
                <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $projectCount }}</p>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">User Designer</h2>
                <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $userCounts['designer'] }}</p>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">User Fotografer</h2>
                <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $userCounts['fotografer'] }}</p>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Sosial Media</h2>
                <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $userCounts['socialMedia'] }}</p>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Admin</h2>
                <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $userCounts['admin'] }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
