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
            $table->string('customer_id')
                ->references('id_customer')
                ->on('customers')
                ->onDelete('cascade');
            $table->string('employee_id')
                ->references('id_employee')
                ->on('employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->date('transaction_date');
            $table->integer('transaction_grandtotal')->default(0);
            $table->enum('transaction_status',['pending','complete'])->default('pending');
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
