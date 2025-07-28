<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Tambah Pesanan</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-white">Judul:</label>
                <input type="text" name="judul" value="{{ old('judul') }}" class="form-input w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-white">Deskripsi:</label>
                <textarea name="deskripsi" class="form-textarea w-full" required>{{ old('deskripsi') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-white">Jenis:</label>
                <select name="jenis" class="form-select w-full" required>
                    <option value="desain">Desain</option>
                    <option value="foto">Foto</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-white">Status:</label>
                <select name="status" class="form-select w-full" required>
                    <option value="menunggu">Menunggu</option>
                    <option value="proses">Proses</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-white">Tanggal Pesanan:</label>
                <input type="date" name="tanggal_pesanan" value="{{ old('tanggal_pesanan', date('Y-m-d')) }}" class="form-input w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-white">Deadline Pesanan:</label>
                <input type="date" name="deadline_pesanan" value="{{ old('deadline_pesanan') }}" class="form-input w-full" required>
            </div>

            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Simpan Pesanan
            </button>
        </form>
    </div>
</x-app-layout>
