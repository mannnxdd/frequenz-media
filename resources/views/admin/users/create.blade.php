<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Tambah User Baru</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-white">Nama:</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-input w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-white">Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-input w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-white">Password:</label>
                <input type="password" name="password" class="form-input w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-white">Konfirmasi Password:</label>
                <input type="password" name="password_confirmation" class="form-input w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-white">Role:</label>
                <select name="role" class="form-select w-full">
                    @foreach($roles as $role)
                        <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>

            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Simpan User</button>
        </form>
    </div>
</x-app-layout>
