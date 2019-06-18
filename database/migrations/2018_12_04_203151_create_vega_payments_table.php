<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVegaPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vega_payments', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id');
          $table->integer('course_id');
          $table->string('course_name');
          $table->string('format')->nullable();
          $table->integer('summ');
          $table->dateTime('confirmation')->nullable();
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
        Schema::dropIfExists('vega_payments');
    }
}
