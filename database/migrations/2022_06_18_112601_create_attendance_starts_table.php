<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceStartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_starts', function (Blueprint $table) {
            $table->id('id_attendance_start');
            $table->time('attendance_start');
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
        Schema::dropIfExists('attendance_starts');
    }
}
