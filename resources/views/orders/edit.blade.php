<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Edit Pesanan</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('orders.update', $order) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-white">Judul:</label>
                <input type="text" name="judul" value="{{ old('judul', $order->judul) }}" class="form-input w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-white">Deskripsi:</label>
                <textarea name="deskripsi" class="form-textarea w-full" required>{{ old('deskripsi', $order->deskripsi) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-white">Jenis:</label>
                <select name="jenis" class="form-select w-full" required>
                    <option value="desain" {{ $order->jenis == 'desain' ? 'selected' : '' }}>Desain</option>
                    <option value="foto" {{ $order->jenis == 'foto' ? 'selected' : '' }}>Foto</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-white">Status:</label>
                <select name="status" class="form-select w-full" required>
                    <option value="menunggu" {{ $order->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="proses" {{ $order->status == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-white">Tanggal Pesanan:</label>
                <input type="date" name="tanggal_pesanan" value="{{ old('tanggal_pesanan', $order->tanggal_pesanan) }}" class="form-input w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-white">Deadline:</label>
                <input type="date" name="deadline_pesanan" value="{{ old('deadline_pesanan', $order->deadline_pesanan) }}" class="form-input w-full" required>
            </div>

            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                Simpan Perubahan
            </button>
        </form>
    </div>
</x-app-layout>
