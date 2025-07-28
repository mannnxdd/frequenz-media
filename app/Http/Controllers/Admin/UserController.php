<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name');
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email',
            'role'  => 'required|exists:roles,name',
        ]);

        $user->update($request->only(['name', 'email']));
        $user->syncRoles([$request->role]);

        return redirect()->route('users.index')->with('success', 'User diperbarui');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User dihapus');
    }
    public function create()
{
    $roles = Role::pluck('name')->filter(fn ($role) => in_array($role, ['admin','designer', 'fotografer','social-media']));
    return view('admin.users.create', compact('roles'));
}

public function store(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'role'     => 'required|in:admin,designer,fotografer,social-media',
    ]);

    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $user->assignRole($request->role);

    return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
}
}
