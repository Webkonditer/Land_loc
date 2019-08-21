<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_mode');
            $table->string('mrh_login')->nullable();
            $table->string('mrh_pass1')->nullable();
            $table->string('mrh_pass2')->nullable();
            $table->string('inv_desc')->nullable();
            $table->string('test_pass1')->nullable();
            $table->string('test_pass2')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
