<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $places = [
            '2 places',
            '4 places',
            '5 places',
            '6 places',
            '7 places',
            '8 places',
            '9 places',
            'Autre'
        ];

        foreach ($places as $nom) {
            Place::firstOrCreate(['nom' => $nom]);
        }
    }
}
