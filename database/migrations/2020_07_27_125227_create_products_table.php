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
            $table->String('pcode');
            $table->String('name')->nullable($value=false);
            $table->String('description')->nullable();
            $table->String('brand')->nullable();
            $table->unsignedBigInteger('catID');
            $table->String('barcode');
            $table->double('sellingPrice')->nullable($value=false);
            $table->double('costPrice')->nullable($value=false);
            $table->double('discount')->default(0);
            $table->integer('Qty')->default(0);
            $table->integer('reorder_level')->default(0);
            $table->unsignedBigInteger ('supplierId');
            $table->foreign('catID')->references('id')->on('categories');

            $table->timestamps();
            $table->primary('pcode');

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
