<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customerId')->default('1');
            $table->unsignedBigInteger('staffId')->default('1');
            $table->double('amount');
            $table->double('discount');
            $table->double('taxes');
            $table->foreign('customerId')->references('id')->on('customers')->cascadeOnDelete();
            $table->foreign('staffId')->references('id')->on('employees')->cascadeOnDelete();
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
        Schema::dropIfExists('sales');
    }
}
