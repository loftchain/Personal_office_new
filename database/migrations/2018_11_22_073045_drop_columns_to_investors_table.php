<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnsToInvestorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('investors', function (Blueprint $table) {
            $table->dropColumn('valid_step');
            $table->dropColumn('kyc_step');
            $table->dropColumn('kyc_token');
            $table->dropColumn('valid_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('investors', function (Blueprint $table) {
            $table->integer('valid_step')->default(0);
            $table->integer('kyc_step')->default(1);
            $table->text('kyc_token')->nullable();
            $table->timestamp('valid_at')->nullable();
        });
    }
}
