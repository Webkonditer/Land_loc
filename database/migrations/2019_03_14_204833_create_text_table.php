<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('format_id')->nullable();
            $table->integer('text_x')->nullable();
            $table->integer('text_x_x')->nullable();
            $table->text('text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('text');
    }
}
