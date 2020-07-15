<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParamsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paramsettings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('corners')->default(10);
            $table->double('crossing')->default(10);
            $table->double('dribbling')->default(10);
            $table->double('finishing')->default(10);
            $table->double('first_touch')->default(10);
            $table->double('free_kick')->default(10);
            $table->double('heading')->default(10);
            $table->double('long_shots')->default(10);
            $table->double('long_throws')->default(10);
            $table->double('marking')->default(10);
            $table->double('passing')->default(10);
            $table->double('penalty_taking')->default(10);
            $table->double('tackling')->default(10);
            $table->double('technique')->default(10);
            $table->double('aggression')->default(10);
            $table->double('articipation')->default(10);
            $table->double('bravery')->default(10);
            $table->double('composure')->default(10);
            $table->double('concentration')->default(10);
            $table->double('decisions')->default(10);
            $table->double('determination')->default(10);
            $table->double('flair')->default(10);
            $table->double('leadership')->default(10);
            $table->double('off_ball')->default(10);
            $table->double('positioning')->default(10);
            $table->double('teamwork')->default(10);
            $table->double('vision')->default(10);
            $table->double('work_rate')->default(10);
            $table->double('acceleration')->default(10);
            $table->double('balance')->default(10);
            $table->double('jumping_reach')->default(10);
            $table->double('natural_fitness')->default(10);
            $table->double('pace')->default(10);
            $table->double('stamina')->default(10);
            $table->double('strength')->default(10);
            $table->double('agility')->default(10);

            $table->double('shots')->default(10);
            $table->double('offensive')->default(10);
            $table->double('deffense')->default(10);
            $table->double('aerial_duels')->default(10);
            $table->double('reaction')->default(10);
            $table->double('sprint_speed')->default(10);
            $table->double('areial_reach')->default(10);
            $table->double('command_of_area')->default(10);
            $table->double('communication')->default(10);
            $table->double('eccentricity')->default(10);
            $table->double('handling')->default(10);
            $table->double('kicking')->default(10);
            $table->double('one_on_ones')->default(10);
            $table->double('feet_playing')->default(10);
            $table->double('punching')->default(10);
            $table->double('reflexes')->default(10);
            $table->double('rushing_out')->default(10);
            $table->double('throwing')->default(10);
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
        Schema::dropIfExists('paramsettings');
    }
}
