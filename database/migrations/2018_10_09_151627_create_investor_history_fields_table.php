<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestorHistoryFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_history_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('investor_id')->nullable();
            $table->string('action')->nullable();
            $table->string('info_1')->nullable();
            $table->string('info_2')->nullable();
            $table->timestamp('date')->nullable();
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
        Schema::dropIfExists('investor_history_fields');
    }
}
