<?php

namespace Database\Seeders;

use App\Models\Porte;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PorteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $portes = [
            '2 portes',
            '3 portes',
            '4 portes',
            '5 portes',
            'Autre'
        ];

        foreach ($portes as $nom) {
            Porte::firstOrCreate(['nom' => $nom]);
        }
    }
}
