<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->get();
    return view('orders.index', compact('orders'));
    }

    // ✅ Admin: Form tambah pesanan
    public function create()
    {
        return view('orders.create');
    }

    // ✅ Admin: Simpan pesanan baru
    public function store(Request $request)
    {
        $request->validate([
        'judul'            => 'required|string|max:255',
        'deskripsi'        => 'required|string',
        'jenis'            => 'required|in:desain,foto',
        'status'           => 'required|in:menunggu,proses,selesai',
        'tanggal_pesanan'  => 'required|date',
        'deadline_pesanan' => 'required|date|after_or_equal:tanggal_pesanan',
    ]);

        Order::create([
        'judul'            => $request->judul,
        'deskripsi'        => $request->deskripsi,
        'jenis'            => $request->jenis,
        'status'           => $request->status,
        'tanggal_pesanan'  => $request->tanggal_pesanan,
        'deadline_pesanan' => $request->deadline_pesanan,
        'user_id'          => auth()->id(),
    ]);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    // ✅ Admin: Edit pesanan
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    // ✅ Admin: Update pesanan
    public function update(Request $request, Order $order)
{
    $request->validate([
        'judul'            => 'required|string|max:255',
        'deskripsi'        => 'required|string',
        'jenis'            => 'required|in:desain,foto',
        'status'           => 'required|in:menunggu,proses,selesai',
        'tanggal_pesanan'  => 'required|date',
        'deadline_pesanan' => 'required|date|after_or_equal:tanggal_pesanan',
    ]);

    $order->update($request->all());

    // 🔁 Cek jika status selesai dan belum ada project
    if ($order->status === 'selesai' && !$order->project) {
        \App\Models\Project::create([
            'order_id' => $order->id,
            'status' => 'draft',
        ]);
    }

    return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui.');
}

    // ✅ Admin: Hapus pesanan
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Pesanan dihapus.');
    }

    // ✅ Designer: Lihat pesanan desain saja
    public function designerIndex()
{
    $orders = Order::with('user')
        ->where('jenis', 'desain')
        ->latest()
        ->get();

    return view('orders.desain', compact('orders'));
}

    // ✅ Fotografer: Lihat pesanan foto saja
    public function fotograferIndex()
    {
        $orders = Order::with('user')
        ->where('jenis', 'foto')
        ->latest()
        ->get();

    return view('orders.foto', compact('orders'));
    }
    public function uploadDesain(Request $request, Order $order)
{
    if ($order->jenis !== 'desain') {
        abort(403, 'Hanya bisa upload untuk pesanan desain.');
    }

    $request->validate([
        'hasil_file' => 'required|file|mimes:zip,rar|max:204800',
    ]);

    $path = $request->file('hasil_file')->store('hasil-desain', 'public');

    $order->update([
        'hasil_file' => $path,
        'status' => 'menunggu', // 👈 otomatis ubah status
    ]);
    if (!$order->project) {
    \App\Models\Project::create([
        'order_id' => $order->id,
        'status' => 'draft',
    ]);
}

    return redirect()->back()->with('success', 'Hasil desain berhasil diupload.');
}
public function uploadBukti(Request $request, Order $order)
{
    $request->validate([
    'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:20480', // maks 20MB
]);

    // Simpan file ke folder storage
    $path = $request->file('bukti_pembayaran')->store('bukti-pembayaran', 'public');

    // Simpan path ke database
    $order->bukti_pembayaran = $path;
    $order->status_pembayaran = 'selesai';
    $order->status = 'selesai';
    if (!$order->project) {
    \App\Models\Project::create([
        'order_id' => $order->id,
        'status' => 'draft',
    ]);
}

    $order->save(); // INI WAJIB!

    return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload.');
}
public function markAsDone(Order $order)
{
    if ($order->jenis !== 'foto') {
        abort(403, 'Hanya pesanan foto yang bisa diselesaikan oleh fotografer.');
    }

    $order->update([
        'status' => 'selesai',
    ]);
    if (!$order->project) {
    \App\Models\Project::create([
        'order_id' => $order->id,
        'status' => 'draft',
    ]);
}

    return redirect()->back()->with('success', 'Pesanan telah ditandai sebagai selesai.');
}
}
