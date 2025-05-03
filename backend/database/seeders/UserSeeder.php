<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('nom', 'admin')->first();
        $userRole  = Role::where('nom', 'user')->first();

        User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'nom' => 'Admin',
            'prenom' => 'Admin',
            'pseudo' => 'AdminAutygo',
            'password' => Hash::make('Admin2025!'),
            'role_id' => $adminRole?->id,
        ]);

        User::firstOrCreate([
            'email' => 'user@example.com',
        ], [
            'nom' => 'User',
            'prenom' => 'User',
            'pseudo' => 'UserAutygo',
            'password' => Hash::make('User2025!'),
            'role_id' => $userRole?->id,
        ]);

        User::factory(100)->create();
    }
}
