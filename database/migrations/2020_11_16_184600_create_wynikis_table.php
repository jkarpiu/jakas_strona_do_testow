<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWynikisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wynikis', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_dzial');
            $table->integer('active_test_id');
            $table->integer('teacher_test_id') -> nullable();
            $table->integer('max_points');
            $table->integer('points');
            $table->boolean('passed');
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
        Schema::dropIfExists('wynikis');
    }
}
