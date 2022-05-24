<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // -> bikin product dan pilih item yang akan di gunakan 
        // -> pada saat transaksi, data item akan diambil dan digunakan untuk menjalankan method subtractInventory

        Schema::create('inventory_products', function (Blueprint $table) {
            $table->id('id_inventory_product');
            $table->string('product_id')
                ->references('id_product')
                ->on('products')
                ->onDelete('cascade');
            $table->string('inventory_id')
                ->references('id_inventory')
                ->on('inventories')
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
        Schema::dropIfExists('inventory__products');
    }
}
