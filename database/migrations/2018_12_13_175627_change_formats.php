<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFormats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('formats', function (Blueprint $table) {
          $table->text('bonus_1')->nullable()->change();
          $table->text('bonus_2')->nullable()->change();
          $table->text('text_1');
          $table->text('text_2')->nullable();
          $table->text('text_3')->nullable();
          $table->text('text_4')->nullable();
          $table->text('text_5')->nullable();
          $table->text('text_6')->nullable();
          $table->text('text_7')->nullable();
          $table->text('text_8')->nullable();
          $table->text('text_9')->nullable();
          $table->text('text_10')->nullable();
          $table->text('text_11')->nullable();
          $table->text('text_12')->nullable();
          $table->text('text_13')->nullable();
          $table->text('text_14')->nullable();
          $table->text('text_15')->nullable();
          $table->text('video_1')->nullable();
          $table->text('video_2')->nullable();
          $table->text('video_3')->nullable();
          $table->text('video_4')->nullable();
          $table->text('video_5')->nullable();
          $table->text('video_6')->nullable();
          $table->text('video_7')->nullable();
          $table->text('video_8')->nullable();
          $table->text('video_9')->nullable();
          $table->text('video_10')->nullable();
          $table->text('video_11')->nullable();
          $table->text('video_12')->nullable();
          $table->text('video_13')->nullable();
          $table->text('video_14')->nullable();
          $table->text('video_15')->nullable();          
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
