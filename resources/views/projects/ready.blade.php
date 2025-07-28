<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Proyek Siap Dipublikasikan</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">
        @forelse($projects as $project)
            <div class="bg-white dark:bg-gray-800 p-4 rounded shadow mb-4">
                <strong class="text-white">{{ $project->order->judul }}</strong> <br>
                <span class="text-white">Jenis: {{ $project->order->jenis }}</span> <br>
                <span class="text-white">Publikasi: 
                    <span class="font-bold {{ $project->is_published ? 'text-green-400' : 'text-yellow-400' }}">
                        {{ $project->is_published ? 'Sudah' : 'Belum' }}
                    </span>
                </span>

                @if(!$project->is_published)
                    <form method="POST" action="{{ route('projects.publish.update', $project->id) }}" class="mt-2">
                        @csrf
                        @method('PATCH')

                        <label class="block mb-1 text-sm text-white">Jadwal Publikasi:</label>
                        <input type="datetime-local" name="publish_at" required class="form-input rounded w-full mb-2">

                        <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Jadwalkan Publikasi
                        </button>
                    </form>
                @else
                    <p class="mt-2 text-sm text-green-500">📅 Dijadwalkan: {{ \Carbon\Carbon::parse($project->publish_at)->format('d M Y H:i') }}</p>
                @endif
            </div>
        @empty
            <p class="text-gray-500 dark:text-gray-300 text-center">Belum ada proyek yang siap dipublikasikan.</p>
        @endforelse
    </div>
</x-app-layout>
