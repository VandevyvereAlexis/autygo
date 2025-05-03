<?php

namespace Database\Seeders;

use App\Models\Transmission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transmissions = [
            'Manuelle',
            'Automatique',
            'Semi-automatique',
            'CVT',
            'Robotisée double embrayage',
            'Autre'
        ];

        foreach ($transmissions as $nom) {
            Transmission::firstOrCreate(['nom' => $nom]);
        }
    }
}
