<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdpowiedzisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odpowiedzis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('tresc');
            $table->boolean('poprawna');
            $table->integer('opcja'); 
            $table->integer('id_pytanie');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('odpowiedzis');
    }
}
