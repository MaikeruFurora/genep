<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_voucher_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cash_voucher_id');
            $table->foreign('cash_voucher_id')->references('id')->on('cash_vouchers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('chart_account_id');
            $table->foreign('chart_account_id')->references('id')->on('chart_accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->double('amount',18,4);
            $table->double('ewTaxPercent',18,4);
            $table->double('inputVat',18,4);
            $table->double('ewTax',18,4);
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
        Schema::dropIfExists('cash_voucher_details');
    }
};
