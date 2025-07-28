<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        foreach (['admin', 'designer', 'fotografer', 'social-media'] as $role) {
        Role::firstOrCreate(['name' => $role]);
    }

    // Admin
    $admin = User::updateOrCreate(
        ['email' => 'admin@studio.com'],
        ['name' => 'Admin', 'password' => bcrypt('password')]
    );
    $admin->assignRole('admin');

    // Fotografer
    $foto = User::updateOrCreate(
        ['email' => 'fotografer@studio.com'],
        ['name' => 'Fotografer', 'password' => bcrypt('password')]
    );
    $foto->assignRole('fotografer');
    }
}
