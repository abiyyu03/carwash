<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id('id_transaction_detail');
            $table->integer('transaction_detail_amount')->nullable();
            $table->date('transaction_detail_date');
            $table->integer('transaction_detail_total');
            $table->string('transaction_id')
                ->references('id_transaction')
                ->on('transactions')
                ->onDelete('cascade');
            $table->integer('product_id')
                ->references('id_product')
                ->on('products')
                ->onDelete('cascade');
            $table->integer('product_category_id')
                ->references('id_product_category')
                ->on('product_categories')
                ->onDelete('cascade');
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
        Schema::dropIfExists('transaction_details');
    }
}
