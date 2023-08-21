<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_login', function (Blueprint $table) {
            $table->id();
            $table->integer('e_id');
            $table->date('login_date');
            $table->time('start_time');
            $table->decimal('start_lat', 10, 8);
            $table->decimal('start_long', 10, 8);
            $table->float('login_location_diff');
            $table->string('reason', 500)->nullable();
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
        Schema::dropIfExists('attendance_login');
    }
}
