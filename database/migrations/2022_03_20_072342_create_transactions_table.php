<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->integer('id_transaction')->primary();
            $table->unsignedBigInteger('customer_id')->references('id_customer')->on('customers');
            $table->unsignedBigInteger('user_id')->references('id_user')->on('users');
            $table->timestamp('transaction_time');
            $table->string('transaction_status')->default();
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
        Schema::dropIfExists('transactions');
    }
}
