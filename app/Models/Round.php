<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;


    public function bigBang()
    {
        // KABOOOOOOM
        // Server Soft Reset

        // End Round // TODO this should also disable access to the game.
        $round = Round::current()->first();
        $round->ended_at = now();
        $round->save();


        // TODO
        // Create a leaderboard
        // Most Kills
        // Most Buildings
        // Most Cash
        // Most Stamina
        // Most Strength
        // etc



        // Set all users back
        User::query()->update(['evolution_id' => Evolution::first()->id]);
        

        // Lower stats for each user depending on Evolution, Stamina, Strength and Item Buffs.
        // The higher the score, the less your stats are worsened.


        // Remove all users items

        // Remove all users collectible items but make them available at a different location

        // TODO
        // Destroy location that bomb is exploded in???
        // If we do that, we could make another location pop up somewhere else?


        // Create the next round
        Round::create(['started_at' => now(), 'number' => Round::all()->count() + 1]);

    }

}
