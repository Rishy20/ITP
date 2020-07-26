<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('emp_id')->unique;
            $table->string('first_name');
            $table->string('last_name');
            $table->string('nic')->unique;
            $table->string('phone');
            $table->date('birthday');
            $table->string('address');
            $table->string('target');
            $table->float('salary');
            $table->string('salary_type');
            $table->float('commission');
            $table->date('joined_date');
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
        Schema::dropIfExists('employees');
    }
}
