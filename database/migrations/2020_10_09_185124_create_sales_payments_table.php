<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salesId');
            $table->string('payment_type');
            $table->float('amount');
            $table->integer('last_four_digits')->length(4)->nullable();
            $table->unsignedBigInteger('voucherId')->nullable();
            $table->foreign('salesId')->references('id')->on('sales')->cascadeOnDelete();
            $table->foreign('voucherId')->references('id')->on('vouchers')->cascadeOnDelete();
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
        Schema::dropIfExists('sales_payments');
    }
}
