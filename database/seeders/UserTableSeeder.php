<?php

namespace Database\Seeders;

use App\Factories\CharacterFactory;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function __construct(
        private CharacterFactory $characterFactory,
    )
    {
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Password is 'password'
        $users = User::factory(30)
            ->create()
            ->each(function(User $user) {
                $this->characterFactory->createForUser($user);
            });

    }
}
