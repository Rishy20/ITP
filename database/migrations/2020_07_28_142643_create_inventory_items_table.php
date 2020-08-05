<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->foreignId('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
            $table->foreignId('product_id')->references('pcode')->on('products')->onDelete('cascade');
            $table->integer('qty')->default(0);
            $table->timestamps();
            $table->primary(['inventory_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_items');
    }
}
