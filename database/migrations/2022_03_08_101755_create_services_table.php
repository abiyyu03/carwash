<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id('id_service');
            $table->string('service_name');
            $table->string('service_code');
            $table->double('service_price');
            $table->string('service_image');
            $table->integer('product_category_id')
                ->references('id_product_category')
                ->on('product_categories')
                ->onDelete('cascade');
            $table->integer('vehicle_type_id')
                ->references('id_vehicle_type')
                ->on('vehicle_types')
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
        Schema::dropIfExists('services');
    }
}
