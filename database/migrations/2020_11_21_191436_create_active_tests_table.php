<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateActiveTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_tests', function (Blueprint $table) {
            $table->id();
            $table->dateTime('deadLine') ->nullable();
            $table->string('token');
            $table->integer('dzial_id') -> nullable();
            $table->integer('teacher_test_id') -> nullable();
            $table->boolean('sent') -> default(0);
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
        Schema::dropIfExists('active_tests');
    }
}
