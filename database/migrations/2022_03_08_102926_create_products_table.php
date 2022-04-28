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
            $table->double('product_price');
            $table->integer('product_stock');
            $table->string('product_image');
            $table->integer('product_category_id')
                ->references('id_product_category')
                ->on('product_categories')
                ->onDelete('cascade');
            // $table->foreign('product_type_id')
            //     ->references('id_product_type')
            //     ->on('product_types')
            //     ->onDelete('cascade');
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
