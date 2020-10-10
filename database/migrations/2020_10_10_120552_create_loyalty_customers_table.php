<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltyCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyalty_customers', function (Blueprint $table) {

                $table->id();
                $table->unsignedBigInteger('loyaltyId')->default('3');
                $table->unsignedBigInteger('customerId');
                $table->integer('points');
                $table->foreign('customerId')->references('id')->on('customers');
                $table->foreign('loyaltyId')->references('id')->on('loyalty');
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
        Schema::dropIfExists('loyalty_customers');
    }
}
