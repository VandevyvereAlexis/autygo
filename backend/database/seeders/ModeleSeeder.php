<?php

namespace Database\Seeders;

use App\Models\Marque;
use App\Models\Modele;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModeleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modelesParMarque = [
            'Ford' => ['Fiesta', 'Focus', 'Mustang', 'Kuga', 'Puma'],
            'Fiat' => ['500', 'Panda', 'Tipo', 'Punto', 'Bravo'],
            'Opel' => ['Corsa', 'Astra', 'Insignia', 'Mokka', 'Zafira'],
            'Citroën' => ['C3', 'C4', 'C5 Aircross', 'Berlingo', 'DS3'],
            'Nissan' => ['Micra', 'Juke', 'Qashqai', 'Leaf', 'X-Trail'],
            'Hyundai' => ['i10', 'i20', 'i30', 'Tucson', 'Kona'],
            'Kia' => ['Picanto', 'Rio', 'Ceed', 'Sportage', 'Niro'],
            'Mazda' => ['Mazda2', 'Mazda3', 'Mazda6', 'CX-3', 'CX-5'],
            'Chevrolet' => ['Spark', 'Aveo', 'Cruze', 'Malibu', 'Camaro'],
            'Dacia' => ['Sandero', 'Logan', 'Duster', 'Spring', 'Jogger'],
            'Lexus' => ['CT', 'IS', 'ES', 'RX', 'NX'],
            'Jaguar' => ['XE', 'XF', 'XJ', 'F-Pace', 'E-Pace'],
            'Land Rover' => ['Defender', 'Discovery', 'Range Rover', 'Evoque', 'Velar'],
            'Jeep' => ['Renegade', 'Compass', 'Cherokee', 'Wrangler', 'Grand Cherokee'],
            'Suzuki' => ['Swift', 'Baleno', 'Vitara', 'S-Cross', 'Jimny'],
            'Mitsubishi' => ['Space Star', 'Lancer', 'ASX', 'Eclipse Cross', 'Outlander'],
            'Subaru' => ['Impreza', 'Legacy', 'Forester', 'Outback', 'XV'],
            'Volvo' => ['V40', 'S60', 'V60', 'XC60', 'XC90'],
            'Skoda' => ['Fabia', 'Octavia', 'Superb', 'Karoq', 'Kodiaq'],
            'Honda' => ['Jazz', 'Civic', 'Accord', 'HR-V', 'CR-V'],
            'Alfa Romeo' => ['Giulietta', 'Giulia', 'Stelvio', 'MiTo', '159'],
            'Chrysler' => ['300C', 'Pacifica', 'Sebring', 'PT Cruiser'],
            'Dodge' => ['Charger', 'Challenger', 'Durango', 'Journey', 'Ram'],
            'Mini' => ['Mini 3 portes', 'Mini 5 portes', 'Clubman', 'Countryman', 'Cabrio'],
            'Seat' => ['Ibiza', 'Leon', 'Arona', 'Ateca', 'Tarraco'],
            'Cadillac' => ['CT4', 'CT5', 'XT4', 'XT5', 'Escalade'],
            'Porsche' => ['911', 'Cayenne', 'Macan', 'Panamera', 'Taycan'],
            'Bentley' => ['Continental GT', 'Flying Spur', 'Bentayga', 'Mulsanne', 'Azure'],
            'Ferrari' => ['488 GTB', 'F8 Tributo', 'Roma', 'Portofino', 'SF90 Stradale'],
            'Lamborghini' => ['Huracán', 'Aventador', 'Urus', 'Gallardo', 'Murciélago'],
            'Bugatti' => ['Veyron', 'Chiron', 'Divo', 'Centodieci', 'Bolide'],
            'Rolls-Royce' => ['Phantom', 'Ghost', 'Wraith', 'Dawn', 'Cullinan'],
            'Maserati' => ['Ghibli', 'Quattroporte', 'Levante', 'GranTurismo', 'MC20'],
            'Infiniti' => ['Q30', 'Q50', 'Q60', 'QX50', 'QX60'],
            'Saab' => ['9-3', '9-5', '900', '9000', '9-4X'],
            'Smart' => ['Fortwo', 'Forfour', 'EQ Fortwo', 'EQ Forfour', 'Roadster'],
            'Rover' => ['25', '45', '75', 'Streetwise', 'MG ZR'],
            'Daewoo' => ['Matiz', 'Lanos', 'Nubira', 'Leganza', 'Tacuma'],
            'Lancia' => ['Ypsilon', 'Delta', 'Thema', 'Voyager', 'Lybra'],
            'Genesis' => ['G70', 'G80', 'G90', 'GV70', 'GV80'],
            'Cupra' => ['Formentor', 'Born', 'Tavascan'],
            'Polestar' => ['Polestar 1', 'Polestar 2', 'Polestar 3', 'Polestar 4', 'Polestar 5'],
            'Tesla' => ['Model S', 'Model 3', 'Model X', 'Model Y', 'Cybertruck'],
            'Mercedes-Benz' => ['Classe A', 'Classe B', 'Classe C', 'Classe E', 'Classe S'],
            'BMW' => ['Série 1', 'Série 2', 'Série 3', 'Série 4', 'Série 5'],
            'Volkswagen' => ['Golf', 'Polo', 'Passat', 'Tiguan', 'Touareg'],
            'Audi' => ['A1', 'A3', 'A4', 'A5', 'A6'],
            'Renault' => ['Clio', 'Mégane', 'Captur', 'Koleos', 'Talisman'],
            'Peugeot' => ['208', '308', '508', '3008', '5008'],
        ];

        foreach ($modelesParMarque as $nomMarque => $modeles) {
            $marque = Marque::where('nom', $nomMarque)->first();

            if ($marque) {
                foreach ($modeles as $nomModele) {
                    Modele::firstOrCreate([
                        'nom' => $nomModele,
                        'marque_id' => $marque->id,
                    ]);
                }
            }
        }
    }
}
