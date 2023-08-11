<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CerateAllEmployeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_employe_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emp_code')->unique();
            $table->string('employe_name', 500);
            $table->string('employe_father_name', 500);
            $table->integer('gender_id');
            $table->integer('designation_id');
            $table->date('DOB');
            $table->date('join_date');
            $table->integer('phone')->unique();
            $table->string('email', 100)->unique();
            $table->string('blood_group', 100);
            $table->string('bank_name', 300);
            $table->string('account_no', 300)->unique();
            $table->string('IFSC_code', 300);
            $table->string('branch_name', 300);
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
        Schema::dropIfExists('all_employe_details');
    }
}
