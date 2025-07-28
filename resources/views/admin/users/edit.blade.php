<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Edit User</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-white">Nama:</label>
                <input name="name" value="{{ old('name', $user->name) }}" class="form-input w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-white">Email:</label>
                <input name="email" value="{{ old('email', $user->email) }}" class="form-input w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-white">Role:</label>
                <select name="role" class="form-select w-full">
                    @foreach($roles as $role)
                        <option value="{{ $role }}" @if($user->hasRole($role)) selected @endif>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
