<?php

namespace Database\Seeders;

use App\Models\Energie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnergieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $energies = [
            'Essence',
            'Diesel',
            'Électrique',
            'Hybride',
            'GPL',
            'Hydrogène',
            'Bioéthanol',
            'GNV',
            'Autre'
        ];

        foreach ($energies as $nom) {
            Energie::firstOrCreate(['nom' => $nom]);
        }
    }
}
