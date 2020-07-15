<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('player_id')->unsigned();
            $table->double('corners')->default(0);
            $table->double('crossing')->default(0);
            $table->double('dribbling')->default(0);
            $table->double('finishing')->default(0);
            $table->double('first_touch')->default(0);
            $table->double('free_kick')->default(0);
            $table->double('heading')->default(0);
            $table->double('long_shots')->default(0);
            $table->double('long_throws')->default(0);
            $table->double('marking')->default(0);
            $table->double('passing')->default(0);
            $table->double('penalty_taking')->default(0);
            $table->double('tackling')->default(0);
            $table->double('technique')->default(0);
            $table->double('aggression')->default(0);
            $table->double('articipation')->default(0);
            $table->double('bravery')->default(0);
            $table->double('composure')->default(0);
            $table->double('concentration')->default(0);
            $table->double('decisions')->default(0);
            $table->double('determination')->default(0);
            $table->double('flair')->default(0);
            $table->double('leadership')->default(0);
            $table->double('off_ball')->default(0);
            $table->double('positioning')->default(0);
            $table->double('teamwork')->default(0);
            $table->double('vision')->default(0);
            $table->double('work_rate')->default(0);
            $table->double('acceleration')->default(0);
            $table->double('balance')->default(0);
            $table->double('jumping_reach')->default(0);
            $table->double('natural_fitness')->default(0);
            $table->double('pace')->default(0);
            $table->double('stamina')->default(0);
            $table->double('strength')->default(0);
            $table->double('agility')->default(0);
            
            $table->double('shots')->default(0);
            $table->double('offensive')->default(0);
            $table->double('deffense')->default(0);
            $table->double('aerial_duels')->default(0);
            $table->double('reaction')->default(0);
            $table->double('sprint_speed')->default(0);
            $table->double('areial_reach')->default(0);
            $table->double('command_of_area')->default(0);
            $table->double('communication')->default(0);
            $table->double('eccentricity')->default(0);
            $table->double('handling')->default(0);
            $table->double('kicking')->default(0);
            $table->double('one_on_ones')->default(0);
            $table->double('feet_playing')->default(0);
            $table->double('punching')->default(0);
            $table->double('reflexes')->default(0);
            $table->double('rushing_out')->default(0);
            $table->double('throwing')->default(0);

            $table->timestamps();

            $table->foreign('player_id')
                ->references('id')
                ->on('players')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parameters');
    }
}
