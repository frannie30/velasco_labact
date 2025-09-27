<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Province;

class ProvinceFactory extends Factory
{
    protected $model = Province::class;

    public function definition(): array
    {
        $provinces = [
            // Luzon
            'Abra', 'Apayao', 'Benguet', 'Ifugao', 'Kalinga', 'Mountain Province',
            'Ilocos Norte', 'Ilocos Sur', 'La Union', 'Pangasinan',
            'Batanes', 'Cagayan', 'Isabela', 'Nueva Vizcaya', 'Quirino',
            'Aurora', 'Bataan', 'Bulacan', 'Nueva Ecija', 'Pampanga', 'Tarlac', 'Zambales',
            'Batangas', 'Cavite', 'Laguna', 'Quezon', 'Rizal',
            'Marinduque', 'Occidental Mindoro', 'Oriental Mindoro', 'Palawan', 'Romblon',
            'Albay', 'Camarines Norte', 'Camarines Sur', 'Catanduanes', 'Masbate', 'Sorsogon',

            // Visayas
            'Aklan', 'Antique', 'Capiz', 'Guimaras', 'Iloilo', 'Negros Occidental',
            'Bohol', 'Cebu', 'Negros Oriental', 'Siquijor',
            'Biliran', 'Eastern Samar', 'Leyte', 'Northern Samar', 'Samar', 'Southern Leyte',

            // Mindanao
            'Zamboanga del Norte', 'Zamboanga del Sur', 'Zamboanga Sibugay',
            'Bukidnon', 'Camiguin', 'Lanao del Norte', 'Misamis Occidental', 'Misamis Oriental',
            'Compostela Valley', 'Davao del Norte', 'Davao del Sur', 'Davao Occidental', 'Davao Oriental',
            'Cotabato', 'Sarangani', 'South Cotabato', 'Sultan Kudarat',
            'Agusan del Norte', 'Agusan del Sur', 'Dinagat Islands', 'Surigao del Norte', 'Surigao del Sur',
            'Basilan', 'Lanao del Sur', 'Maguindanao del Norte', 'Maguindanao del Sur',
            'Sulu', 'Tawi-Tawi'
        ];

        return [
            'name' => $this->faker->randomElement($provinces),
        ];
    }
}
