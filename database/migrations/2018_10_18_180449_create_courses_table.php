<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position');
            $table->string('image',255)->nullable();
            $table->string('name',100);
            $table->string('nic',100)->nullable();
            $table->text('description')->nullable();
            $table->text('module')->nullable();
            $table->integer('summ')->nullable();
            $table->string('monthly',255)->nullable();
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
        Schema::dropIfExists('courses');
    }
}
