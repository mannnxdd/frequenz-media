<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('order')->latest()->paginate(10);
        return view('projects.ready', compact('projects'));
    }

    // Admin: Buat proyek dari order yang sudah selesai
    public function create()
    {
        $orders = Order::where('status', 'selesai')->get();
        return view('projects.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);

        Project::create([
            'order_id' => $request->order_id,
            'status' => 'draft',
        ]);

        return redirect()->route('projects.index')->with('success', 'Proyek dibuat.');
    }

    public function edit(Project $project)
    {
        $orders = Order::where('status', 'selesai')->get();
        return view('projects.edit', compact('project', 'orders'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|in:draft,selesai',
        ]);

        $project->update($request->only(['order_id', 'status']));

        return redirect()->route('projects.index')->with('success', 'Proyek diperbarui.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyek dihapus.');
    }

    // Role Social Media: tampilkan proyek yang order-nya sudah selesai
    public function readyToPublish()
    {
        $projects = Project::with('order')
    ->whereHas('order', function ($query) {
        $query->where('status', 'selesai');
    })
    ->get();

        return view('projects.ready', compact('projects'));
    }

    // Social Media: update status publikasi
    public function publish(Request $request, Project $project)
{
    $request->validate([
        'publish_at' => 'required|date|after:now',
    ]);

    $project->update([
        'publish_at' => \Carbon\Carbon::parse($request->publish_at),
        'is_published' => true,
    ]);

    return redirect()->route('projects.publish')->with('success', 'Proyek dijadwalkan untuk publikasi.');
}
}