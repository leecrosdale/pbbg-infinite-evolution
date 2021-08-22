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
            $table->json('recipe')->nullable(); // { ["item_id": 1, "qty": 5], ["item_id": 2, "qty": 1] }
            $table->json('buffs')->nullable(); // { "attack": 50, "defence": -1 }
            $table->foreignId('evolution_id')->references('id')->on('evolutions');
            $table->foreignId('location_id')->nullable()->references('id')->on('locations');
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
