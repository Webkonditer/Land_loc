<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddText2Formats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('formats', function (Blueprint $table) {
          $table->text('text2_1');
          $table->text('text2_2')->nullable();
          $table->text('text2_3')->nullable();
          $table->text('text2_4')->nullable();
          $table->text('text2_5')->nullable();
          $table->text('text2_6')->nullable();
          $table->text('text2_7')->nullable();
          $table->text('text2_8')->nullable();
          $table->text('text2_9')->nullable();
          $table->text('text2_10')->nullable();
          $table->text('text2_11')->nullable();
          $table->text('text2_12')->nullable();
          $table->text('text2_13')->nullable();
          $table->text('text2_14')->nullable();
          $table->text('text2_15')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
