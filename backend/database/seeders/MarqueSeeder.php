<?php

namespace Database\Seeders;

use App\Models\Marque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marques = [
            'Toyota', 'Peugeot', 'Renault', 'Mercedes-Benz', 'BMW',
            'Volkswagen', 'Audi', 'Tesla', 'Ford', 'Fiat',
            'Opel', 'Citroën', 'Nissan', 'Hyundai', 'Kia',
            'Mazda', 'Chevrolet', 'Dacia', 'Lexus', 'Jaguar',
            'Land Rover', 'Jeep', 'Suzuki', 'Mitsubishi', 'Subaru',
            'Volvo', 'Skoda', 'Honda', 'Alfa Romeo', 'Chrysler',
            'Dodge', 'Mini', 'Seat', 'Cadillac', 'Porsche',
            'Bentley', 'Ferrari', 'Lamborghini', 'Bugatti', 'Rolls-Royce',
            'Maserati', 'Infinity', 'Saab', 'Smart', 'Rover',
            'Daewoo', 'Lancia', 'Genesis', 'Cupra', 'Polestar'
        ];

        foreach ($marques as $nom) {
            Marque::firstOrCreate(['nom' => $nom]);
        }
    }
}
