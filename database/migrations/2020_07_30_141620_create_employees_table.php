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
            $table->string('fname');
            $table->string('lname');
            $table->string('nic')->unique;
            $table->string('address');
            $table->string('mobile');
            $table->string('home');
            $table->date('birthday');
            $table->date('joined_date');
            $table->string('target');
            $table->float('salary');
            $table->string('salary_type');
            $table->float('commission');
           
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
