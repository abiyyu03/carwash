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
            $table->integer('product_capital_price')->default(0); //di isi saat belanja
            $table->integer('product_stock')->default(0); //di isi saat belanja
            $table->integer('product_minimum_stock')->default(0); 
            // $table->integer('product_discount')->default(0);
            $table->integer('product_category_id')
                ->references('id_product_category')
                ->on('product_categories')
                ->onDelete('cascade');
            $table->string('is_active')->default('1');
            $table->string('is_promo')->default('0');
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
