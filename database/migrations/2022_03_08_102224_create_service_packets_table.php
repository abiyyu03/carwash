<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicePacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_packets', function (Blueprint $table) {
            $table->id('id_service_packet');
            $table->string('service_packet_name');
            $table->string('vehicle_type_id')->references('id_vehicle_type')->on('vehicle_types');
            $table->integer('service_packet_price');
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
        Schema::dropIfExists('service_packets');
    }
}
