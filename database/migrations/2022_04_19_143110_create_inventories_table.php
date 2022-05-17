<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id('id_inventory');
            $table->string('inventory_name');
            $table->string('inventory_code');
            $table->integer('inventory_unit'); // jumlah barang
            $table->integer('inventory_capital_price'); //harga modal
            // $table->integer('inventory_volume')->nullable(); //banyaknya volume per unit (satuan ML)
            // $table->integer('inventory_dosage')->nullable(); //dosis per pemakaian (satuan ML)
            $table->integer('inventory_usage')->nullable(); 
            $table->integer('inventory_usable')->nullable(); 
            $table->integer('supplier_id')
                ->references('id_supplier')
                ->on('suppliers')
                ->onDelete('cascade')
                ->nullable();
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
        Schema::dropIfExists('inventories');
    }
}
