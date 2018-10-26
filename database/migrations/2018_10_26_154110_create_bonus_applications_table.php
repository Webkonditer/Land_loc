<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonusApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonus_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('donator_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->integer('bonus_points')->nullable();
            $table->string('bonus')->nullable();
            $table->integer('summ');
            $table->string('status')->default('Необработана');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonus_applications');
    }
}
