<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameSomeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendance_login', function (Blueprint $table) {
            $table->renameColumn('start_time', 'login_time');
            $table->renameColumn('start_lat', 'login_lat');
            $table->renameColumn('start_long', 'login_long');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendance_login', function (Blueprint $table) {
            $table->renameColumn('login_time', 'start_time');
            $table->renameColumn('login_lat', 'start_lat');
            $table->renameColumn('login_long', 'start_long');
        });
    }
}
