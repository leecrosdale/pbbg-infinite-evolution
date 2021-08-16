<?php

namespace Database\Factories;

use App\Models\Evolution;
use Illuminate\Database\Eloquent\Factories\Factory;

class EvolutionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Evolution::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->word,
            'name' => $this->faker->word,
            'requirements' => [ 'experience' => $this->faker->numberBetween(1,1000)]
        ];
    }
}
