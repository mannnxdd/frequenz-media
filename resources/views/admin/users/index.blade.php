<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Manajemen User</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- 🔘 Tombol Tambah User -->
            <div class="flex justify-end mb-4">
                <a href="{{ route('users.create') }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition">
                    ➕ Tambah User
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @foreach($users as $user)
                    <div class="mb-4 border-b pb-2">
                        <strong class="text-lg text-gray-800 dark:text-white">{{ $user->name }}</strong>
                        <span class="text-sm text-gray-500">({{ $user->email }})</span><br>
                        <span class="text-sm text-gray-600 dark:text-gray-300">Role: {{ $user->roles->pluck('name')->first() ?? 'Tidak Ada' }}</span>

                        <div class="mt-2 space-x-3">
                            <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:underline">✏️ Edit</a>

                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Hapus user ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">🗑️ Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <!-- ✅ Pagination -->
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
