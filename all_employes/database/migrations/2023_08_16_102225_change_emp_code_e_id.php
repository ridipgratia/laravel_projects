<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeEmpCodeEId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('all_employe_login', function (Blueprint $table) {
            $table->renameColumn('emp_code', 'e_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('all_employe_login', function (Blueprint $table) {
            $table->renameColumn('e_id', 'emp_code');
        });
    }
}
