<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMontherName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('all_employe_details', function (Blueprint $table) {
            $table->string('employe_mother_name', 300)->after('employe_father_name');
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
            $table->dropColumn('mother_name');
        });
    }
}
