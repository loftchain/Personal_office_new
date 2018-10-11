<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestorPersonalFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_personal_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('investor_id')->unsigned()->nullable();
            $table->string('name_surname')->nullable();
            $table->string('phone')->nullable();
            $table->string('date_place_birth')->nullable();
            $table->longText('doc_img_path')->nullable();
            $table->timestamps();
        });

        Schema::table('investor_personal_fields', function($table) {
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
        Schema::dropIfExists('investor_personal_fields');
    }
}
