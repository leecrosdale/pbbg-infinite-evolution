<?php

namespace Database\Factories;

use App\Models\Evolution;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique->city;
        $evolution = Evolution::inRandomOrder()->first();

        return [
            'evolution_id' => $evolution->id,
            'slug' => Str::slug($name),
            'name' => $name,
        ];
    }
}
