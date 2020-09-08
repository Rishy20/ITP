<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('productID');
            $table->unsignedBigInteger('customerID');
            $table->unsignedBigInteger('salesmanID');
            $table->float('amount');
            $table->foreign('productID')->references('id')->on('products')->cascadeOnDelete();
            $table->foreign('customerID')->references('id')->on('customers')->cascadeOnDelete();
            $table->foreign('salesmanID')->references('id')->on('employees')->cascadeOnDelete();
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
        Schema::dropIfExists('exchanges');
    }
}
