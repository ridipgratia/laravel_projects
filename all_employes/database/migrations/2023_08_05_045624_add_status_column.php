<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('all_employe_details', function (Blueprint $table) {
            $table->integer('status')->comment('1 For Active Employe And 0 For Deactive Employe')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('all_employe_details', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
