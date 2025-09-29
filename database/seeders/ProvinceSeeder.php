<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            'Region I - Ilocos Region' => [
                'Ilocos Norte', 'Ilocos Sur', 'La Union', 'Pangasinan'
            ],
            'Region II - Cagayan Valley' => [
                'Batanes', 'Cagayan', 'Isabela', 'Nueva Vizcaya', 'Quirino'
            ],
            'Region III - Central Luzon' => [
                'Aurora', 'Bataan', 'Bulacan', 'Nueva Ecija', 'Pampanga', 'Tarlac', 'Zambales'
            ],
            'Region IV-A - CALABARZON' => [
                'Batangas', 'Cavite', 'Laguna', 'Quezon', 'Rizal'
            ],
            'Region IV-B - MIMAROPA' => [
                'Marinduque', 'Occidental Mindoro', 'Oriental Mindoro', 'Palawan', 'Romblon'
            ],
            'Region V - Bicol Region' => [
                'Albay', 'Camarines Norte', 'Camarines Sur', 'Catanduanes', 'Masbate', 'Sorsogon'
            ],
            'CAR - Cordillera Administrative Region' => [
                'Abra', 'Apayao', 'Benguet', 'Ifugao', 'Kalinga', 'Mountain Province'
            ],
            'NCR - National Capital Region' => [
                // NCR has no provinces
            ],
            'Region VI - Western Visayas' => [
                'Aklan', 'Antique', 'Capiz', 'Guimaras', 'Iloilo', 'Negros Occidental'
            ],
            'Region VII - Central Visayas' => [
                'Bohol', 'Cebu', 'Negros Oriental', 'Siquijor'
            ],
            'Region VIII - Eastern Visayas' => [
                'Biliran', 'Eastern Samar', 'Leyte', 'Northern Samar', 'Samar', 'Southern Leyte'
            ],
            'Region IX - Zamboanga Peninsula' => [
                'Zamboanga del Norte', 'Zamboanga del Sur', 'Zamboanga Sibugay'
            ],
            'Region X - Northern Mindanao' => [
                'Bukidnon', 'Camiguin', 'Lanao del Norte', 'Misamis Occidental', 'Misamis Oriental'
            ],
            'Region XI - Davao Region' => [
                'Compostela Valley', 'Davao del Norte', 'Davao del Sur', 'Davao Occidental', 'Davao Oriental'
            ],
            'Region XII - SOCCSKSARGEN' => [
                'Cotabato', 'Sarangani', 'South Cotabato', 'Sultan Kudarat'
            ],
            'CARAGA' => [
                'Agusan del Norte', 'Agusan del Sur', 'Dinagat Islands', 'Surigao del Norte', 'Surigao del Sur'
            ],
            'BARMM - Bangsamoro Autonomous Region' => [
                'Basilan', 'Lanao del Sur', 'Maguindanao del Norte', 'Maguindanao del Sur', 'Sulu', 'Tawi-Tawi'
            ],
        ];

        foreach ($regions as $region => $provinces) {
            foreach ($provinces as $province) {
                Province::create(['name' => $province, 'region' => $region]);
            }
        }
    }
}
