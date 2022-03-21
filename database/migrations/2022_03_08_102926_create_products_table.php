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
            $table->text('product_description');
            $table->integer('product_stock');
            $table->unsignedBigInteger('product_category_id')->references('id_product_category')->on('product_categories');
            $table->unsignedBigInteger('supplier_id')->references('id_supplier')->on('suppliers');
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


