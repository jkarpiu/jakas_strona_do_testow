<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDzialiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dzialies', function (Blueprint $table) {
            $table->id();
            $table->string('nazwa');
            $table->float('prog', 5, 2) -> max(100.00) ->default(50);
            $table->integer('ilosc_pytan') -> max(500) -> default(40);
            $table->integer('owner_id') -> nullable();
            $table->boolean('public') -> default(false);
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
        Schema::dropIfExists('dzialies');
    }
}
