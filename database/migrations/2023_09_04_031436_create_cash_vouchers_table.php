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
        Schema::create('cash_vouchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('bp_master_data_id');
            $table->foreign('bp_master_data_id')->references('id')->on('bp_master_data')->onDelete('cascade')->onUpdate('cascade');
            $table->string('particulars');
            $table->double('amount');
            $table->string('cvno',100);
            $table->string('bank',100);
            $table->string('checkno',100);
            $table->date('cvdate',100);
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
        Schema::dropIfExists('cash_vouchers');
    }
};
