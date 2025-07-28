<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
    Role::create(['name' => 'designer']);
    Role::create(['name' => 'fotografer']);
    Role::create(['name' => 'social-media']);

    $admin = User::create([
        'name' => 'Admin',
        'email' => 'admin@studio.com',
        'password' => bcrypt('password'),
    ]);
    $admin->assignRole('admin');
    }
}
