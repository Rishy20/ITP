<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique()->nullable($value = false);
            $table->string('display_name')->nullable($value = false);
            $table->string('password')->nullable($value = false);
            $table->integer('pin')->nullable($value = false);
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('roleId');
            $table->foreign('roleId')->references('id')->on('user_roles')->cascadeOnDelete();
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
        Schema::dropIfExists('users');
    }
}
