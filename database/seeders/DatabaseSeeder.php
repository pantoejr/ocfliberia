<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Role::create([
        //     'name' => 'superadmin'
        // ]);

        // Role::create([
        //     'name' => 'admin',
        // ]);

        // Role::create([
        //     'name' => 'staff',
        // ]);

        User::create([
            'name' => 'Joel Pantoe Jr',
            'email' => 'pantoejr@gmail.com',
            'password' => Hash::make('P@55w0rd'),
            'contact' => '0778337220',
            'login_hint' => 'P@55w0rd',
            'address' => '5th Street',
            'is_active' => true,
        ]);
    }
}
