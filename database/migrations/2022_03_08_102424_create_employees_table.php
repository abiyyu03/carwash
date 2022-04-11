<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('id_employee');
            $table->string('employee_fullname');
            $table->string('employee_nickname');
            $table->string('employee_nik');
            $table->string('employee_photo');
            $table->date('employee_birthdate');
            $table->string('employee_gender');
            $table->string('employee_contact');
            $table->string('employee_email');
            $table->text('employee_address');
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
        Schema::dropIfExists('employees');
    }
}
