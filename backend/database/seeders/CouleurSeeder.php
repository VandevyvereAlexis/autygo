<?php

namespace Database\Seeders;

use App\Models\Couleur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouleurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $couleurs = [
            'Noir',
            'Blanc',
            'Gris',
            'Argent',
            'Bleu',
            'Rouge',
            'Vert',
            'Jaune',
            'Orange',
            'Marron',
            'Beige',
            'Violet',
            'Rose',
            'Autre'
        ];

        foreach ($couleurs as $nom) {
            Couleur::firstOrCreate(['nom' => $nom]);
        }
    }
}
