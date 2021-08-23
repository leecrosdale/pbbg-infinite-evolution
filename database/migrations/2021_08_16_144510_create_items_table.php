<?php

use App\Enums\ItemType;
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

            $table->foreignId('evolution_id')->constrained();
            $table->foreignId('location_id')->nullable()->constrained();

            $table->string('type')->default(ItemType::BASE);
            $table->string('name');
            $table->json('recipe')->nullable(); // { ["item_id": 1, "qty": 5], ["item_id": 2, "qty": 1] }
            $table->json('buffs')->nullable(); // { "attack": 50, "defence": -1 }
            $table->boolean('available')->default(true); // Collectible only, false once found, true when dropped / round resets
            $table->integer('chance_percentage')->default(100); // Collectible only

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
