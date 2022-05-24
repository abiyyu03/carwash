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
            $table->string('id_transaction')->primary();
            $table->integer('customer_id')
                ->references('id_customer')
                ->on('customers')
                ->onDelete('cascade');
            $table->string('employee_id')
                ->references('id_employee')
                ->on('employees')
                ->onDelete('cascade');
            $table->timestamp('transaction_timestamp');
            $table->integer('transaction_grandtotal')->nullable();
            $table->string('transaction_status')->default('pending');
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
