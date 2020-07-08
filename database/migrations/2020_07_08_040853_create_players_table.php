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
            $table->string('name', 100);
            $table->string('surename', 100)->nullable();
            $table->string('naciality', 100);
            $table->date('birth_date');
            $table->integer('height');
            $table->integer('weight');
            $table->string('foot');
            $table->string('photo', 100)->nullable();
            $table->string('current_team');

            $table->string('main_pos');
            $table->string('sec_pos');
            $table->string('third_pos')->nullable();
            $table->string('fourth_pos')->nullable();
            $table->string('fifth_pos')->nullable();

            $table->double('corners');
            $table->double('crossing');
            $table->double('dribbling');
            $table->double('finishing');
            $table->double('first_touch');
            $table->double('free_kick');
            $table->double('heading');
            $table->double('long_shots');
            $table->double('long_throws');
            $table->double('marking');
            $table->double('passing');
            $table->double('penalty_taking');
            $table->double('tacking');
            $table->double('technique');
            $table->double('aggression');
            $table->double('articipation');
            $table->double('bravery');
            $table->double('composure');
            $table->double('concentration');
            $table->double('decisions');
            $table->double('determination');
            $table->double('flair');
            $table->double('leadership');
            $table->double('off_ball');
            $table->double('positioning');
            $table->double('teamwork');
            $table->double('vision');
            $table->double('work_rate');
            $table->double('acceleration');
            $table->double('balance');
            $table->double('jumping_reach');
            $table->double('natural_fitness');
            $table->double('pace');
            $table->double('stamina');
            $table->double('strength');

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