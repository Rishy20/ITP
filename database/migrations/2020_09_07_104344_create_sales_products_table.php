<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_products', function (Blueprint $table) {
            $table->unsignedBigInteger('saleId');
            $table->unsignedBigInteger('pid');
            $table->integer('qty');
            $table->integer('price');
            $table->integer('discount');
            $table->foreign('saleId')->references('id')->on('sales')->cascadeOnDelete();
            $table->foreign('pid')->references('id')->on('products')->cascadeOnDelete();
            $table->primary(['saleId','pid']);
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
        Schema::dropIfExists('sales_products');
    }
}
