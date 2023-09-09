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
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('bp_master_data_id')->nullable();
            $table->foreign('bp_master_data_id')->references('id')->on('bp_master_data')->onDelete('cascade')->onUpdate('cascade');
            $table->string('payment_others',100)->nullable();
            $table->string('particulars');
            $table->double('amount');
            $table->string('cvno',100);
            $table->string('bank',100)->nullable();
            $table->string('checkno',100)->nullable();
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
