<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendance_login', function (Blueprint $table) {
            $table->time('logout_time')->nullable();
            $table->decimal('logout_lat', 10, 8)->nullable();
            $table->decimal('logout_long', 10, 8)->nullable();
            $table->float('logout_diff')->nullable();
            $table->integer('logout_location_id')->nullable();
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
            $table->dropColumn('logout_time');
            $table->dropColumn('logout_lat');
            $table->dropColumn('logout_long');
            $table->dropColumn('logout_diff');
            $table->dropColumn('logout_location_id');
        });
    }
}
