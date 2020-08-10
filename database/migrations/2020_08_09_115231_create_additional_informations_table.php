<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('player_id');
            $table->string('languages');
            $table->string('national_team');
            $table->date('first_appearance_date');
            $table->string('first_appearance_team');
            $table->date('first_appearance_division');
            $table->date('contact_expires');
            $table->double('market_value');
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
        Schema::dropIfExists('additional_informations');
    }
}
