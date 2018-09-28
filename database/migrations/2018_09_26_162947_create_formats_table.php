<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formats', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('position');
          $table->string('image',255);
          $table->string('name',100);
          $table->integer('summ');
          $table->string('monthly',255);
          $table->string('bonus_1',255);
          $table->string('bonus_2',255);
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
        Schema::dropIfExists('formats');
    }
}
