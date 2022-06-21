<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_details', function (Blueprint $table) {
            $table->id('id_work_detail');
            $table->integer('transaction_detail_id')
                ->references('id_transaction_detail')
                ->on('transaction_details')
                ->onDelete('cascade');
            $table->string('employee_id')
                ->references('id_employee')
                ->on('employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->date('date')->default(date('Y-m-d'));
            $table->integer('commission');  
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
        Schema::dropIfExists('work_details');
    }
}
