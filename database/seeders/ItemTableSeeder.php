<?php

namespace Database\Seeders;

use App\Enums\ItemType;
use App\Factories\ItemFactory;
use App\Models\Evolution;
use App\Models\Item;
use App\Models\Location;
use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ItemFactory $factory)
    {

        Item::factory()->create(['name' => 'Wood', 'type' => ItemType::BASE, 'evolution_id' => Evolution::first()->id]);
        Item::factory()->create(['name' => 'Stone', 'type' => ItemType::BASE, 'evolution_id' => Evolution::first()->id]);
        Item::factory()->create(['name' => 'Gold', 'type' => ItemType::BASE, 'evolution_id' => Evolution::first()->id]);
        Item::factory()->create(['name' => 'Food', 'type' => ItemType::BASE, 'evolution_id' => Evolution::first()->id]);


        $weapons = Item::factory(20)->create(['type' => ItemType::WEAPON]);
        $armors = Item::factory(20)->create(['type' => ItemType::ARMOR]);
        $tools = Item::factory(20)->create(['type' => ItemType::TOOL]);



        foreach ($weapons as $weapon)
        {
            $factory->generateRandomRecipe($weapon);
            $factory->generateRandomBuff($weapon);
        }

        foreach ($armors as $armor)
        {
            $factory->generateRandomRecipe($armor);
            $factory->generateRandomBuff($armor);
        }

        foreach ($tools as $tool)
        {
            $factory->generateRandomRecipe($tool);
            $factory->generateRandomBuff($tool);
        }

        // Random Collectibles
        Item::factory(5)->create(['type' => ItemType::COLLECTIBLE])->each(function (Item $item) use ($factory) {
            $item->location_id = Location::all()->random(1)->first()->id;
            $item->save();

            $factory->generateRandomBuff($item);

        });



    }
}
