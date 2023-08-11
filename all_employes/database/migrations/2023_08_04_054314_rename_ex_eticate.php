<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameExEticate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employe_expirience', function (Blueprint $table) {
            $table->renameColumn('ex_certificae', 'ex_certificate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employe_expirience', function (Blueprint $table) {
            $table->renameColumn('ex_certificate', 'ex_certificae ');
        });
    }
}
