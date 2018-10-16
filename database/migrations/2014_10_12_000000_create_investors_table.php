<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin')->default(0);
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->integer('valid_step')->default(0);
            $table->integer('kyc_step')->default(1);
            $table->text('kyc_token')->nullable();
            $table->timestamp('valid_at')->nullable();
            $table->string('token')->nullable();
            $table->string('ip_token')->nullable();
            $table->integer('confirmed')->default(0);
            $table->integer('referred_by')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->integer('reg_attempts')->default(0);
            $table->integer('reset_attempts')->default(0);
            $table->string('img')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('investors');
    }
}
