<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained();
//            $table->foreignId('clan_id')->nullable()->constrained();
            $table->foreignId('evolution_id')->constrained(); // todo: derive in code instead based on experience?
            $table->foreignId('location_id')->constrained();

            $table->integer('level');
            $table->integer('experience');

            $table->integer('health');
            $table->integer('max_health');
            $table->integer('energy');
            $table->integer('max_energy');

            $table->integer('strength');
            $table->integer('stamina');

            $table->dateTime('last_sleep_at');
            $table->dateTime('last_heal_at');
            $table->dateTime('last_train_at');
            $table->dateTime('last_attack_at');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
