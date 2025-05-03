<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Citadine',
            'Berline',
            'Break',
            'SUV',
            'Monospace',
            'Coupé',
            'Cabriolet',
            'Pick-up',
            'Utilitaire',
            '4x4',
            'Autre'
        ];

        foreach ($types as $nom) {
            Type::firstOrCreate(['nom' => $nom]);
        }
    }
}
