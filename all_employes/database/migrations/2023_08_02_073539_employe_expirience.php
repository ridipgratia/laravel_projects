<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmployeExpirience extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employe_expirience', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('e_id');
            $table->string('company_name', 300);
            $table->string('ex_year', 300);
            $table->date('to_date');
            $table->date('form_date');
            $table->string('ex_certificae', 200);
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
        Schema::dropIfExists('employe_expirience');
    }
}
