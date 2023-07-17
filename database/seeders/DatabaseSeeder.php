<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $adminUser = User::factory()->create([
            'email' => 'admin@gmail.com',
            'name' => 'Admin',
            'password' => Hash::make('password'),
        ]);
        //Creating Admin User

        $adminRole = Role::create(['name' => 'admin']);
        // Creating Admin role

        $adminUser->assignRole($adminRole);
        // Assigning Admin the role of admin

        // \App\Models\Post::factory(50)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
