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
            $table->string('id_employee')->primary(); //advice : create using timestamp
            $table->integer('user_id')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade');
            $table->string('employee_fullname');
            $table->string('employee_nik')->nullable();
            $table->string('employee_photo')->nullable();
            $table->date('employee_birthdate')->nullable();
            $table->string('employee_gender');
            $table->string('employee_contact')->nullable();
            $table->text('employee_address')->nullable();
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
