<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->String('description');
            $table->String('brand');
            $table->unsignedBigInteger('catID');
            $table->String('barcode');
            $table->double('sellingPrice');
            $table->double('costPrice');
            $table->double('discount');
            $table->integer('Qty');
            $table->integer('reorder_level');
            $table->unsignedBigInteger ('supplierId');
            $table->foreign('catID')->references('id')->on('categories');

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
        Schema::dropIfExists('products');
    }
}
