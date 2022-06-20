<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_leaves', function (Blueprint $table) {
            $table->id('id_attendance_leave');
            $table->time('attendance_leave');
            $table->unsignedBigInteger('attendance_schedule_id')
                ->references('id_attendance_schedule')
                ->on('attendance_schedules');
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
        Schema::dropIfExists('attendance_leaves');
    }
}
