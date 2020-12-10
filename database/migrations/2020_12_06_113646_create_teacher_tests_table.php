<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_tests', function (Blueprint $table) {
            $table->id();
            $table->dateTime("start");
            $table->integer("duration");
            $table->integer('threshold')->max(100) -> min(0);
            $table->integer('questionsAmount');
            $table->string('name');
            $table->integer('groups_model_id');
            $table->integer("dzialy_id");
            $table->integer('teacher_id');
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
        Schema::dropIfExists('teacher_tests');
    }
}
