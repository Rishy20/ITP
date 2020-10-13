<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_returns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('returnId');
            $table->unsignedBigInteger('productId');
            $table->unsignedBigInteger('variantId')->nullable();
            $table->integer('qty');
            $table->foreign('returnId')->references('id')->on('return_products')->cascadeOnDelete();
            $table->foreign('productId')->references('id')->on('products')->cascadeOnDelete();
            $table->foreign('variantId')->references('id')->on('variants')->cascadeOnDelete();
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
        Schema::dropIfExists('product_returns');
    }
}
