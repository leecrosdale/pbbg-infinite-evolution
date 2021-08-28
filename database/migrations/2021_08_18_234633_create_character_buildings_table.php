<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterBuildingsTable extends Migration
{
    public function up()
    {
        Schema::create('character_buildings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('character_id')->constrained()->onDelete('cascade');
            $table->foreignId('location_id')->constrained();

            // VARCHAR type because database-level ENUMs kinda suck to work with
            // for sqlite testing and changing column to add values
            $table->string('type');

            $table->integer('level');

            $table->integer('health');
            $table->integer('max_health');

            $table->dateTime('work_started_at')->nullable();
            $table->dateTime('next_work_at')->nullable();

            $table->timestamps();

            $table->unique([
                'character_id',
                'location_id',
                'type',
            ]);
        });
    }

    public function down()
    {
        Schema::dropIfExists('character_buildings');
    }
}
