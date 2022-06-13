<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_details', function (Blueprint $table) {
            $table->id('id_inventory_detail');
            $table->string('inventory_detail_name');
            $table->string('inventory_detail_amount');
            $table->integer('inventory_detail_price');
            $table->integer('product_id')
                ->references('id_product')
                ->on('products')
                ->onDelete('cascade')->nullable();
            $table->integer('inventory_id')
                ->references('id_inventory')
                ->on('inventories')
                ->onDelete('cascade')->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('supplier_contact')->nullable();
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
        Schema::dropIfExists('inventory_details');
    }
}
