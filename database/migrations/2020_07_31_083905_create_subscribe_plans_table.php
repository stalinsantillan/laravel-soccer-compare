<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribe_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plan_type')->comment('Type(Basic Month, Pro Month, Basic Year, Pro Year)');
            $table->string('plan_name')->comment('Plan Name (string)');
            $table->string('plan_description')->comment('Plan Description(string)');
            $table->string('trial_payment_name')->comment('Trial Payment Name(string)');
            $table->string('trial_frequency')->comment('Frequency(DAY, WEEK, MONTH, YEAR)');
            $table->string('trial_frequency_interval')->comment('Frequency interval(string, ex.1)');
            $table->string('trial_cycle')->comment('Trial Cycle(Trial period, String)');
            $table->double('trial_amount')->comment('Trial value(double)');
            $table->string('trial_currency')->comment('Trial currency(String, USD, EUR, AUD, ...)');
            $table->string('regular_payment_name')->comment('Regular Payment Name(string)');
            $table->string('regular_frequency')->comment('Frequency(DAY, WEEK, MONTH, YEAR)');
            $table->string('regular_frequency_interval')->comment('Frequency interval(string, ex.1)');
            $table->string('regular_cycle')->comment('Regular Cycle(Trial period, String)');
            $table->double('regular_amount')->comment('Regular value(double)');
            $table->string('regular_currency')->comment('Regular currency(String, USD, EUR, AUD, ...)');
            $table->string('return_url')->comment('Return URL(http://localhost:8081/subscribe/paypal/return)');
            $table->string('cancel_url')->comment('Cancel URL(http://localhost:8081/subscribe/paypal/cancel)');
            $table->string('plan_id')->comment('String(P-3UY19752R35501734UC7JKMQ)');
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
        Schema::dropIfExists('subscribe_plans');
    }
}
