<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductpromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productpromotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('promotionid');
            $table->unsignedBigInteger('productid');
            $table->unsignedBigInteger('variantid')->nullable($value=true);
            $table->foreign('promotionid')->references('id')->on('promotions')->cascadeOnDelete();
            $table->foreign('productid')->references('id')->on('products')->cascadeOnDelete();
            $table->foreign('variantid')->references('id')->on('variants')->cascadeOnDelete();
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
        Schema::dropIfExists('productpromotions');
    }
}
