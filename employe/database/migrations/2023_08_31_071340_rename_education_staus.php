<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameEducationStaus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('child_details', function (Blueprint $table) {
            $table->renameColumn('education_status', 'child_disabled_file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('child_details', function (Blueprint $table) {
            $table->renameColumn('child_disabled_file', 'education_status');
        });
    }
}
