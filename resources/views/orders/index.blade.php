<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Daftar Pesanan
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Tombol tambah -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('orders.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                ➕ Tambah Pesanan
            </a>
        </div>

        <!-- Tabel pesanan -->
        <div class="bg-white dark:bg-gray-800 shadow overflow-x-auto sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">#</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Judul</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Jenis</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Pembayaran</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Deadline</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Pemesan</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Hasil</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Bukti Bayar</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($orders as $index => $order)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ $order->judul }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ ucfirst($order->jenis) }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ ucfirst($order->status) }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ ucfirst($order->status_pembayaran ?? 'menunggu') }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ \Carbon\Carbon::parse($order->tanggal_pesanan)->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ \Carbon\Carbon::parse($order->deadline_pesanan)->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ $order->user->name ?? '-' }}</td>

                            <!-- Kolom hasil desain -->
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                @if ($order->jenis === 'foto' && $order->status === 'selesai')
                                    <span class="text-green-600 font-semibold">✅ Done</span>
                                @elseif ($order->hasil_file)
                                    <a href="{{ asset('storage/' . $order->hasil_file) }}" target="_blank" class="text-green-600 hover:underline">
                                        📎 Lihat File
                                    </a>
                                @else
                                    <span class="text-gray-400">Belum ada</span>
                                @endif
                            </td>

                            <!-- Kolom bukti pembayaran -->
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                @if ($order->bukti_pembayaran)
                                    <a href="{{ asset('storage/' . $order->bukti_pembayaran) }}" target="_blank" class="text-green-600 hover:underline">
                                        📎 Lihat Bukti
                                    </a>
                                @else
                                    <form action="{{ route('orders.uploadBukti', $order) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="bukti_pembayaran" class="text-sm mb-1" required>
                                        <button type="submit" class="text-indigo-600 hover:underline text-sm">Upload</button>
                                    </form>
                                @endif
                            </td>

                            <!-- Tombol aksi -->
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200 space-x-2">
                                <a href="{{ route('orders.edit', $order) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('orders.destroy', $order) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pesanan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="px-4 py-4 text-center text-gray-500 dark:text-gray-300">Belum ada pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
