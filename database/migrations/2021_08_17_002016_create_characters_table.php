<?php

use App\Enums\CharacterStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // todo: remove nullable?
//            $table->foreignId('clan_id')->nullable()->constrained();
            $table->foreignId('evolution_id')->constrained(); // todo: derive in code instead based on experience?
            $table->foreignId('location_id')->constrained();

            $table->string('status')->default(CharacterStatus::FREE);

            $table->string('name');

            $table->integer('level');
            $table->integer('experience');

            $table->integer('health');
            $table->integer('max_health');
            $table->integer('energy');
            $table->integer('max_energy');

            $table->integer('stat_attack');
            $table->integer('stat_defence');

            $table->dateTime('status_free_at')->nullable();
            $table->dateTime('last_sleep_at')->nullable();
            $table->dateTime('last_heal_at')->nullable();
            $table->dateTime('last_train_at')->nullable();
            $table->dateTime('last_attack_at')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
