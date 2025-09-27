<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Province;

class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    public function definition(): array
    {
        return [
            'user_id' => '1',
            'province_id' => Province::inRandomOrder()->first()->id,
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(10),
            'ingredients' => [
                $this->faker->word(),
                $this->faker->word(),
                $this->faker->word(),
                $this->faker->word(),
            ],
            'recipe' => [
                "Prepare {$this->faker->word()}",
                "Add {$this->faker->word()}",
                "Cook until {$this->faker->word()}",
                "Serve and enjoy!",
            ],
        ];
    }
}
