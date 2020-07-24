<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('country_name', 500);
            $table->string('country_link', 500);
            $table->string('competition_name', 500);
            $table->string('competition_link', 500);
            $table->string('team_name', 500);
            $table->string('team_link', 500);
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
        Schema::dropIfExists('api_teams');
    }
}
