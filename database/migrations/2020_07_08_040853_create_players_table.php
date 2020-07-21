<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('surename');
            $table->string('nationality');
            $table->date('birth_date');
            $table->integer('height');
            $table->integer('weight');
            $table->string('foot');
            $table->string('photo')->nullable();
            $table->string('current_team');

            $table->double('technical_average')->default(0);
            $table->double('mental_average')->default(0);
            $table->double('physical_average')->default(0);
            $table->double('general_average')->default(0);
            $table->double('goalkeeper_average')->default(0);

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
        Schema::dropIfExists('players');
    }
}
