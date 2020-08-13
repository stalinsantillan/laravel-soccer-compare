<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoutReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scout_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('player_id');
            $table->text('general_info')->nullable();
            $table->text('strengths')->nullable();
            $table->text('weaknesses')->nullable();
            $table->text('pros')->nullable();
            $table->text('cons')->nullable();
            $table->integer('conclusion')->nullable()->default(0);
            $table->text('other')->nullable();
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
        Schema::dropIfExists('scout_reports');
    }
}
