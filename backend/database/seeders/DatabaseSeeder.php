<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MarqueSeeder::class);
        $this->call(ModeleSeeder::class);
        $this->call(EnergieSeeder::class);
        $this->call(TransmissionSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(PorteSeeder::class);
        $this->call(PlaceSeeder::class);
        $this->call(CouleurSeeder::class);
        $this->call(ConditionSeeder::class);
    }
}
