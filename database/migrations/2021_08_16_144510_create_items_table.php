<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('type')->default(\App\Enums\ItemType::BASE);
            $table->string('name');
            $table->json('recipe')->nullable();
            $table->json('buffs')->nullable(); // TODO work out how to make sure buffs are applied / removed.
            $table->foreignId('evolution_id')->references('id')->on('evolutions');
            $table->foreignId('location_id')->nullable()->references('id')->on('locations'); // Collectibles should have a location, maybe we make this it's own thing?


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
