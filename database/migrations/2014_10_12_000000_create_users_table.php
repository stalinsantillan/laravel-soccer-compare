<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('status');
            $table->integer('is_subscribed')->default(0)->nullable();
            $table->integer('subscribe_id')->default(0)->nullable();
            $table->string('plan_id')->default('')->nullable();
            $table->string('agreement_id')->default('')->nullable();
            $table->integer('trial_type')->default(0)->nullable();
            $table->date('trial_start')->nullable();
            $table->date('trial_end')->nullable();
            $table->string('remember_token')->nullable();
            $table->integer('limit_count')->nullable()->default(5);

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
        Schema::dropIfExists('users');
    }
}
