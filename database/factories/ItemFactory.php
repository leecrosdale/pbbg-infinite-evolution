<?php

namespace Database\Factories;

use App\Enums\ItemType;
use App\Models\Evolution;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(ItemType::all()),
            'name' => $this->faker->unique->word,
            'evolution_id' => Evolution::all()->random(1)->first()->id,
        ];
    }
}
