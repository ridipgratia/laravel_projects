<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmployeEducationDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employe_education_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('e_id');
            $table->string('board', 300);
            $table->string('degree', 300);
            $table->string('year', 300);
            $table->float('percentage');
            $table->integer('marks');
            $table->string('education_certificate', 300);
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
        Schema::dropIfExists('employe_education_details');
    }
}
