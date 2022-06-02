<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_product');
            $table->string('product_name');
            $table->string('product_code');
            $table->integer('product_price');
            $table->integer('product_capital_price'); //harga modal
            $table->integer('product_stock')->default(1);
            $table->integer('product_minimum_stock')->nullable();
            // $table->string('product_image')->nullable();
            $table->integer('product_discount')->nullable();
            $table->integer('product_category_id')
            ->references('id_product_category')
            ->on('product_categories')
            ->onDelete('cascade');
            $table->integer('supplier_id')
            ->references('id_supplier')
            ->on('suppliers')
            ->onDelete('cascade')
            ->nullable();
            // $table->bool('is_active')->default(true);
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
        Schema::dropIfExists('products');
    }
}
