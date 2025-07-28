<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            Kelola Proyek
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tombol Tambah -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('projects.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md">
                ➕ Tambah Proyek
            </a>
        </div>

        <!-- Tabel Proyek -->
        <div class="bg-white dark:bg-gray-800 shadow overflow-x-auto sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">#</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Judul Order</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Jenis</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Status Order</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Status Proyek</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Publikasi</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($projects as $index => $project)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ $project->order->judul ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ $project->order->jenis ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ ucfirst($project->order->status ?? '-') }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ ucfirst($project->status) }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                @if ($project->publish_at)
                                    <span class="text-green-500 font-semibold">Sudah</span>
                                    <br>
                                    <small>{{ \Carbon\Carbon::parse($project->publish_at)->format('d M Y H:i') }}</small>
                                @else
                                    <span class="text-yellow-400 font-semibold">Belum</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 space-x-2 text-sm text-gray-800 dark:text-gray-200">
                                <a href="{{ route('projects.edit', $project->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus proyek ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-4 text-center text-gray-500 dark:text-gray-300">Belum ada proyek.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
