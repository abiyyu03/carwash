<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_statuses', function (Blueprint $table) {
            $table->id('id_attendance_status');
            $table->unsignedBigInteger('employee_id')
                ->references('id_employee')
                ->on('employees');
            $table->unsignedBigInteger('attendance_start_id')
                ->references('id_attendance_start')
                ->on('attendance_starts')
                ->nullable();
            $table->unsignedBigInteger('attendance_leave_id')
                ->references('id_attendance_leave')
                ->on('attendance_leaves')
                ->nullable();
            $table->unsignedBigInteger('attendance_schedule_id')
                ->references('id_attendance_schedule')
                ->on('attendance_schedules')
                ->nullable();
            $table->enum('attendance_status',['present','absent'])->default('absent');
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('attendance_statuses');
    }
}
