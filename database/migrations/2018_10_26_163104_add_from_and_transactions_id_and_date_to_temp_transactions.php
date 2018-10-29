<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFromAndTransactionsIdAndDateToTempTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('temp_transactions', function (Blueprint $table){
            $table->string('transaction_id');
            $table->string('from');
            $table->dateTime('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temp_transactions', function($table) {
            $table->dropColumn('transaction_id');
            $table->dropColumn('from');
            $table->dropColumn('date');
        });
    }
}
