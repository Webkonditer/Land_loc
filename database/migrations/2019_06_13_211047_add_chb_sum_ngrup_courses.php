<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChbSumNgrupCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::table('courses', function (Blueprint $table) {
           $table->integer('inscription_chb')->nullable();
           $table->integer('from')->nullable();
           $table->integer('to')->nullable();
           $table->integer('ngrup_chb')->nullable();
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
