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
            $table->string('languages')->nullable();
            $table->string('national_team')->nullable();
            $table->date('first_appearance_date')->nullable();
            $table->string('first_appearance_team')->nullable();
            $table->date('first_appearance_division')->nullable();
            $table->date('contact_expires')->nullable();
            $table->double('market_value')->nullable();
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
