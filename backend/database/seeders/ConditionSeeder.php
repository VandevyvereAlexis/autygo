<?php

namespace Database\Seeders;

use App\Models\Condition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conditions = [
            'Neuf',
            'Comme neuf',
            'Très bon état',
            'Bon état',
            'État correct',
            'À réparer',
            'Pour pièces'
        ];

        foreach ($conditions as $nom) {
            Condition::firstOrCreate(['nom' => $nom]);
        }
    }
}
