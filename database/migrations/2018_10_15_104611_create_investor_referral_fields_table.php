<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestorReferralFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_referral_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('investor_id')->unsigned()->nullable();
            $table->string('send')->default('false');
            $table->string('wallet_to')->nullable();
            $table->string('tokens')->nullable();
            $table->double('tokens_referred_by')->nullable();
            $table->timestamps();
        });

        Schema::table('investor_referral_fields', function($table) {
            $table->foreign('investor_id')->references('id')->on('investors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investor_referral_fields');
    }
}
