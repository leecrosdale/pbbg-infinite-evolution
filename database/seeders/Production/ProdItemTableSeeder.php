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
                    'recipe' => ['wood' => 50],
                    'buffs' => ['attack' => 10],
                ],
                'Big Stick' => [
                    'recipe' => ['wood' => 150],
                    'buffs' => ['attack' => 20],
                ],
                'Rock' => [
                    'recipe' => ['stone' => 100],
                    'buffs' => ['attack' => 25, 'defence' => -5],
                ]
            ]
        ],
        1 => [
            ItemType::WEAPON => [
                'Sharp Stick' => [
                    'recipe' => ['wood' => 200],
                    'buffs' => ['attack' => 25],
                ],
                'Stone Axe' => [
                    'recipe' => ['wood' => 150, 'stone' => 150],
                    'buffs' => ['attack' => 40],
                ],
                'Sharp Rock' => [
                    'recipe' => ['stone' => 250],
                    'buffs' => ['attack' => 40, 'defence' => -15],
                ]
            ]
        ],
        2 => [
            ItemType::WEAPON => [
                'Bronze Sword' => [
                    'recipe' => ['wood' => 200, 'stone' => 500, 'gold' => 20],
                    'buffs' => ['attack' => 50],
                ],
                'Bronze Axe' => [
                    'recipe' => ['wood' => 400, 'stone' => 250, 'gold' => 10],
                    'buffs' => ['attack' => 40],
                ],
            ],
            ItemType::TOOL => [
                'Bronze Shield' => [
                    'recipe' => ['stone' => 600, 'gold' => 100],
                    'buffs' => ['defence' => 30, 'attack' => -10],
                ],
            ],
            ItemType::ARMOR => [
                'Bronze Armor' => [
                    'recipe' => ['stone' => 800, 'gold' => 200],
                    'buffs' => ['defence' => 30],
                ],
            ]
        ],
        3 => [
            ItemType::WEAPON => [
                'Iron Axe' => [
                    'recipe' => ['stone' => 2500, 'gold' => 1000, 'food' => 60],
                    'buffs' => ['attack' => 60],
                ],
                'Iron Mace' => [
                    'recipe' => ['stone' => 1500, 'gold' => 300],
                    'buffs' => ['attack' => 30],
                ],
                'Iron Spear' => [
                    'recipe' => ['stone' => 1500, 'gold' => 500, 'food' => 300],
                    'buffs' => ['attack' => 60, 'defence' => -10],
                ],
            ],
            ItemType::ARMOR => [
                'Chain Mail' => [
                    'recipe' => ['stone' => 3500, 'gold' => 1500, 'food' => 900],
                    'buffs' => ['defence' => 70],
                ],
                'Plate Armor' => [
                    'recipe' => ['stone' => 2500, 'gold' => 1000, 'food' => 900],
                    'buffs' => ['defence' => 50],
                ],
            ],
            ItemType::TOOL => [
                'Flail' => [
                    'recipe' => ['stone' => 2500],
                    'buffs' => ['defence' => 10],
                ],
                'Small Knife' => [
                    'recipe' => ['stone' => 3500],
                    'buffs' => ['defence' => 15],
                ],
            ]
        ],
        4 => [
            ItemType::WEAPON => [
                'Steel Axe' => [
                    'recipe' => [
                        'stone' => 4500,
                        'gold' => 2000,
                        'food' => 1200,
                    ],
                    'buffs' => [
                        'attack' => 130,
                    ]
                ],
                'Steel Tipped Spear' => [
                    'recipe' => [
                        'stone' => 3500,
                        'gold' => 1000,
                    ],
                    'buffs' => [
                        'attack' => 90,
                    ]
                ]
            ],
            ItemType::ARMOR => [
                'Steel Armor' => [
                    'recipe' => [
                        'stone' => 3500,
                        'gold' => 1500,
                        'food' => 900,
                    ],
                    'buffs' => [
                        'defence' => 150
                    ]
                ],
            ],
            ItemType::TOOL => [
                'Steel Knife' => [
                    'recipe' => [
                        'stone' => 5500,
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
                        'stone' => 14500,
                        'gold' => 5000,
                        'food' => 12000,
                    ],
                    'buffs' => [
                        'attack' => 240,
                    ]
                ],
                'Halberd' => [
                    'recipe' => [
                        'stone' => 16500,
                        'gold' => 2000,
                    ],
                    'buffs' => [
                        'attack' => 190,
                    ]
                ]
            ],
            ItemType::ARMOR => [
                'Steel Armor' => [
                    'recipe' => [
                        'stone' => 3500,
                        'gold' => 1500,
                        'food' => 900,
                    ],
                    'buffs' => [
                        'defence' => 150
                    ]
                ],
            ],
            ItemType::TOOL => [
                'TNT' => [
                    'recipe' => [
                        'stone' => 15500,
                    ],
                    'buffs' => [
                        'attack' => 60,
                        'defence' => -100
                    ]
                ]
            ]
        ],
        6 => [
            ItemType::WEAPON => [
                'Bazooka' => [
                    'recipe' => [
                        'gold' => 15500,
                        'stone' => 15500,
                    ],
                    'buffs' => [
                        'attack' => 90,
                    ]
                ],
                'Flamethrower' => [
                    'recipe' => [
                        'stone' => 15500,
                        'wood' => 10000,
                    ],
                    'buffs' => [
                        'attack' => 150,
                        'defence' => -100
                    ]
                ],
                'Rifle' => [
                    'recipe' => [
                        'gold' => 15500,
                        'stone' => 15500,
                        'food' => 15500,
                    ],
                    'buffs' => [
                        'attack' => 230,
                    ]
                ],
            ],
            ItemType::ARMOR => [
                'Body Armor' => [
                    'recipe' => [
                        'gold' => 15500,
                        'stone' => 15500,
                        'food' => 15500,
                    ],
                    'buffs' => [
                        'defence' => 210,
                    ]
                ],
            ]
        ],
        7 => [
            ItemType::WEAPON => [
                'Cyber Gun' => [
                    'recipe' => [
                        'stone' => 75000,
                        'food' => 75000,
                        'gold' => 75000,
                        'wood' => 75000,
                    ],
                    'buffs' => [
                        'attack' => 400,
                        'defence' => 50
                    ]
                ]
            ],
            ItemType::ARMOR => [
                'Cyber Armor' => [
                    'recipe' => [
                        'stone' => 75000,
                        'food' => 75000,
                        'gold' => 75000,
                        'wood' => 75000,
                    ],
                    'buffs' => [
                        'defence' => 400,
                        'attack' => 50
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
