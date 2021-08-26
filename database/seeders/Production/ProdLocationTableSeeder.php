<?php

namespace Database\Seeders\Production;

use App\Models\Evolution;
use App\Models\Location;
use Illuminate\Database\Seeder;

class ProdLocationTableSeeder extends Seeder
{
    private const LOCATIONS_PER_EVOLUTION = 5;


    // Key is evolution order
    private $locations = [

        0 => [
            'Carnac'
        ],
        1 => [
            'Silbury',
            'Callanish',
        ],
        2 => [
            'Hili',
            'Nuraxi',
        ],
        3 => [
            'Arc',
            'Siena'
        ],
        4 => [
            'Rome',
            'Diony'
        ],
        5 => [
            'Textile Town',
            'Steam City'
        ],
        6 => [
            'Webopolis',
            'Digitown'
        ],
        7 => [
            'AutoCapitol',
            'Cyberworld'
        ]
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $evolutions = Evolution::all();

        foreach ($evolutions as $evolution) {
            foreach ($this->locations[$evolution->order] as $location) {
                Location::factory()->create(['name' => $location, 'evolution_id' => $evolution->id]);
            }
        }
    }
}
