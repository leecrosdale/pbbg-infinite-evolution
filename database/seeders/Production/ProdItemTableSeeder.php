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
            ItemType::WEAPON => [
                'Iron Axe' => [
                    'recipe' => [
                        'stone' => 250,
                        'gold' => 100,
                        'food' => 60
                    ],
                    'buffs' => [
                        'attack' => 60,
                    ]
                ],
                'Iron Mace' => [
                    'recipe' => [
                        'stone' => 150,
                        'gold' => 30,
                    ],
                    'buffs' => [
                        'attack' => 30,
                    ]
                ],
                'Iron Spear' => [
                    'recipe' => [
                        'stone' => 150,
                        'gold' => 50,
                        'food' => 30
                    ],
                    'buffs' => [
                        'attack' => 60,
                        'defence' => -10
                    ]
                ],
            ],
            ItemType::ARMOR => [
                'Chain Mail' => [
                    'recipe' => [
                        'stone' => 350,
                        'gold' => 150,
                        'food' => 90
                    ],
                    'buffs' => [
                        'defence' => 70
                    ]
                ],
                'Plate Armor' => [
                    'recipe' => [
                        'stone' => 250,
                        'gold' => 100,
                        'food' => 90
                    ],
                    'buffs' => [
                        'defence' => 50
                    ]
                ]
            ],
            ItemType::TOOL => [
                'Flail' => [
                    'recipe' => [
                        'stone' => 250,
                    ],
                    'buffs' => [
                        'defence' => 10
                    ]
                ],
                'Small Knife' => [
                    'recipe' => [
                        'stone' => 350,
                    ],
                    'buffs' => [
                        'defence' => 15
                    ]
                ]
            ]
        ],
        4 => [
            ItemType::WEAPON => [
                'Steel Axe' => [
                    'recipe' => [
                        'stone' => 450,
                        'gold' => 200,
                        'food' => 120
                    ],
                    'buffs' => [
                        'attack' => 130,
                    ]
                ],
                'Steel Tipped Spear' => [
                    'recipe' => [
                        'stone' => 350,
                        'gold' => 100,
                    ],
                    'buffs' => [
                        'attack' => 90,
                    ]
                ]
            ],
            ItemType::ARMOR => [
                'Steel Armor' => [
                    'recipe' => [
                        'stone' => 350,
                        'gold' => 150,
                        'food' => 90
                    ],
                    'buffs' => [
                        'defence' => 150
                    ]
                ],
            ],
            ItemType::TOOL => [
                'Steel Knife' => [
                    'recipe' => [
                        'stone' => 550,
                    ],
                    'buffs' => [
                        'defence' => 30
                    ]
                ]
            ]
        ],
        5 => [
            ItemType::WEAPON => [
                'Hand Cannon' => [
                    'recipe' => [
                        'stone' => 1450,
                        'gold' => 500,
                        'food' => 1200
                    ],
                    'buffs' => [
                        'attack' => 240,
                    ]
                ],
                'Halberd' => [
                    'recipe' => [
                        'stone' => 1650,
                        'gold' => 200,
                    ],
                    'buffs' => [
                        'attack' => 190,
                    ]
                ]
            ],
            ItemType::ARMOR => [
                'Steel Armor' => [
                    'recipe' => [
                        'stone' => 350,
                        'gold' => 150,
                        'food' => 90
                    ],
                    'buffs' => [
                        'defence' => 150
                    ]
                ],
            ],
            ItemType::TOOL => [
                'TNT' => [
                    'recipe' => [
                        'stone' => 1550,
                    ],
                    'buffs' => [
                        'attack' => 60,
                        'defence' => -10
                    ]
                ]
            ]
        ],
        6 => [
            ItemType::WEAPON => [
                'Bazooka' => [
                    'recipe' => [
                        'gold' => 1550,
                        'stone' => 1550,
                    ],
                    'buffs' => [
                        'attack' => 2000,
                    ]
                ],
                'Flamethrower' => [
                    'recipe' => [
                        'stone' => 1550,
                        'wood' => 1000
                    ],
                    'buffs' => [
                        'attack' => 1500,
                        'defence' => 500
                    ]
                ],
                'Rifle' => [
                    'recipe' => [
                        'gold' => 1550,
                        'stone' => 1550,
                        'food' => 1550,
                    ],
                    'buffs' => [
                        'attack' => 2300,
                    ]
                ],
            ],
            ItemType::ARMOR => [
                'Body Armor' => [
                    'recipe' => [
                        'gold' => 1550,
                        'stone' => 1550,
                        'food' => 1550,
                    ],
                    'buffs' => [
                        'defence' => 1300,
                    ]
                ],
            ]
        ],
        7 => [
            ItemType::WEAPON => [
                'Cyber Gun' => [
                    'recipe' => [
                        'stone' => 7500,
                        'food' => 7500,
                        'gold' => 7500,
                        'wood' => 7500
                    ],
                    'buffs' => [
                        'attack' => 4000,
                        'defence' => 1000
                    ]
                ]
            ],
            ItemType::ARMOR => [
                'Cyber Armor' => [
                    'recipe' => [
                        'stone' => 7500,
                        'food' => 7500,
                        'gold' => 7500,
                        'wood' => 7500
                    ],
                    'buffs' => [
                        'defence' => 4000,
                        'attack' => 1000
                    ]
                ]
            ]
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
