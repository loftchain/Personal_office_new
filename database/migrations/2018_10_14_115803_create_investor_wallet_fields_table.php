<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestorWalletFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_wallet_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('investor_id')->unsigned()->nullable();
            $table->string('currency')->nullable();
            $table->string('type')->nullable();
            $table->string('wallet')->nullable();
            $table->string('active')->nullable();
            $table->timestamps();
        });

        Schema::table('investor_wallet_fields', function($table) {
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
        Schema::dropIfExists('investor_wallet_fields');
    }
}
