<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendorID');
            $table->foreign('vendorID')->references('id')->on('vendors');
            $table->foreign('bankID')->references('id')->on('bank_accounts')->nullable()->onDelete('cascade');
            $table->string('paymentType');
            $table->double('amount');
            $table->date('date');
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
        Schema::dropIfExists('vendor_payment');
    }
}
