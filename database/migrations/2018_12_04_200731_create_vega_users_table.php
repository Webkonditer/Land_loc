<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVegaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vega_users', function (Blueprint $table) {
              $table->increments('id');
              $table->string('name');
              $table->string('email');
              $table->string('phone')->nullable();
              $table->string('city')->nullable();
              $table->string('password')->nullable();
              $table->rememberToken()->nullable();
              $table->dateTime('last_payment')->nullable();
              $table->timestamps();
              $table->integer('refer')->nullable();
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vega_users');
    }
}
