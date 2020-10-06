<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_vouchers', function (Blueprint $table) {

                $table->id();
                $table->unsignedBigInteger('saleId');
                $table->unsignedBigInteger('vid');
                $table->integer('discount');
                $table->foreign('saleId')->references('id')->on('sales')->cascadeOnDelete();
                $table->foreign('vid')->references('id')->on('vouchers')->cascadeOnDelete();
                // $table->primary(['saleId','pid','vid']);
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
        Schema::dropIfExists('sales_vouchers');
    }
}
