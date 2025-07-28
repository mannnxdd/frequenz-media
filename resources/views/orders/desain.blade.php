<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Pesanan Desain
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 shadow overflow-x-auto sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">#</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Judul</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Deskripsi</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Deadline</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Pemesan</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Hasil</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($orders as $index => $order)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ $order->judul }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ $order->deskripsi }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ ucfirst($order->status) }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                {{ \Carbon\Carbon::parse($order->tanggal_pesanan)->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                {{ \Carbon\Carbon::parse($order->deadline_pesanan)->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                {{ $order->user->name ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                @if ($order->hasil_file)
                                    <a href="{{ asset('storage/' . $order->hasil_file) }}" target="_blank" class="text-green-600 hover:underline">
                                        📎 Lihat File
                                    </a>
                                @elseif(Auth::user()->hasRole('designer'))
                                    <form action="{{ route('orders.upload', $order) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="hasil_file" class="text-sm mt-1 mb-1 text-gray-600" required>
                                        <button type="submit" class="text-indigo-600 hover:underline text-sm">Upload</button>
                                    </form>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-center text-gray-500 dark:text-gray-300">
                                Tidak ada pesanan desain.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
