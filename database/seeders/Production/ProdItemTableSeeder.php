<?php

namespace Database\Seeders\Production;

use App\Enums\ItemType;
use App\Factories\ItemFactory;
use App\Models\Evolution;
use App\Models\Item;
use App\Models\Location;
use Illuminate\Database\Seeder;

class ProdItemTableSeeder extends Seeder
{


    private $data = [
        0 => [
            ItemType::WEAPON => [
                'Small Stick' => [
                    'recipe' => [
                        'wood' => 5,
                    ],
                    'buffs' => [
                        'attack' => 10
                    ]
                ],
                'Big Stick' => [
                    'recipe' => [
                        'wood' => 15,
                    ],
                    'buffs' => [
                        'attack' => 20
                    ]
                ],
                'Rock' => [
                    'recipe' => [
                        'stone' => 10,
                    ],
                    'buffs' => [
                        'attack' => 20,
                        'defence' => -10
                    ]
                ]
            ]
        ],
        1 => [
            ItemType::WEAPON => [
                'Sharp Stick' => [
                    'recipe' => [
                        'wood' => 20,
                    ],
                    'buffs' => [
                        'attack' => 20
                    ]
                ],
                'Stone Axe' => [
                    'recipe' => [
                        'wood' => 25,
                        'stone' => 15
                    ],
                    'buffs' => [
                        'attack' => 40
                    ]
                ],
                'Sharp Rock' => [
                    'recipe' => [
                        'stone' => 15,
                    ],
                    'buffs' => [
                        'attack' => 40,
                        'defence' => -20
                    ]
                ]
            ]
        ],
        2 => [

            ItemType::WEAPON => [
                'Bronze Sword' => [
                    'recipe' => [
                        'wood' => 20,
                        'stone' => 120,
                        'gold' => 2,
                    ],
                    'buffs' => [
                        'attack' => 50
                    ]
                ],
                'Bronze Axe' => [
                    'recipe' => [
                        'wood' => 20,
                        'stone' => 100,
                        'gold' => 1,
                    ],
                    'buffs' => [
                        'attack' => 40
                    ]
                ]
            ],
            ItemType::TOOL => [
                'Bronze Shield' => [
                    'recipe' => [
                        'stone' => 100,
                        'gold' => 5,
                    ],
                    'buffs' => [
                        'defence' => 30,
                        'attack' => -10
                    ]
                ]
            ],
            ItemType::ARMOR => [
                'Bronze Armor' => [
                    'recipe' => [
                        'stone' => 150,
                        'gold' => 50,
                    ],
                    'buffs' => [
                        'defence' => 30,
                        'attack' => -20
                    ]
                ]
            ]

        ],
        3 => [
        ],
        4 => [
        ],
        5 => [
        ],
        6 => [
        ],
        7 => [
        ]
    ];

    public function run(ItemFactory $factory)
    {

        $firstEvolution = Evolution::query()
            ->where('order', 0)
            ->firstOrFail();

        $baseItems = [
            'Wood',
            'Stone',
            'Gold',
            'Food',
        ];

        foreach ($baseItems as $baseItem) {
            Item::factory()
                ->create([
                    'evolution_id' => $firstEvolution->id,
                    'name' => $baseItem,
                    'type' => ItemType::BASE,
                ]);
        }


        $evolutions = Evolution::all();
        foreach ($evolutions as $evolution) {


            $weapons = $this->data[$evolution->order][ItemType::WEAPON] ?? null;

            if ($weapons) {

                foreach ($weapons as $weaponName => $weaponData) {

                    $recipes = [];
                    foreach ($weaponData['recipe'] as $recipeName => $qty) {
                        $recipes[] = [
                            'item_id' => Item::where('name', $recipeName)->firstOrFail()->id,
                            'qty' => $qty
                        ];
                    }

                    $buffs = [];
                    foreach ($weaponData['buffs'] as $buffType => $amount) {
                        $buffs[$buffType] = $amount;
                    }

                    Item::factory()->create([
                        'name' => $weaponName,
                        'evolution_id' => $evolution->id,
                        'type' => ItemType::WEAPON,
                        'recipe' => $recipes,
                        'buffs' => $buffs
                    ]);
                }
            }

            $armors = $this->data[$evolution->order][ItemType::ARMOR] ?? null;

            if ($armors) {

                foreach ($armors as $armorName => $armorData) {

                    $recipes = [];
                    foreach ($armorData['recipe'] as $recipeName => $qty) {
                        $recipes[] = [
                            'item_id' => Item::where('name', $recipeName)->firstOrFail()->id,
                            'qty' => $qty
                        ];
                    }

                    $buffs = [];
                    foreach ($armorData['buffs'] as $buffType => $amount) {
                        $buffs[$buffType] = $amount;
                    }

                    Item::factory()->create([
                        'name' => $armorName,
                        'evolution_id' => $evolution->id,
                        'type' => ItemType::ARMOR,
                        'recipe' => $recipes,
                        'buffs' => $buffs
                    ]);
                }

            }

            $tools = $this->data[$evolution->order][ItemType::TOOL] ?? null;

            if ($tools) {

                foreach ($tools as $toolName => $toolData) {

                    $recipes = [];
                    foreach ($toolData['recipe'] as $recipeName => $qty) {
                        $recipes[] = [
                            'item_id' => Item::where('name', $recipeName)->firstOrFail()->id,
                            'qty' => $qty
                        ];
                    }

                    $buffs = [];
                    foreach ($toolData['buffs'] as $buffType => $amount) {
                        $buffs[$buffType] = $amount;
                    }

                    Item::factory()->create([
                        'name' => $toolName,
                        'evolution_id' => $evolution->id,
                        'type' => ItemType::TOOL,
                        'recipe' => $recipes,
                        'buffs' => $buffs
                    ]);
                }

            }
        }

    }
}
