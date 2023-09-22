<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddDcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_dc', function (Blueprint $table) {
            $table->id();
            $table->string('submited_by');
            $table->string('code_number');
            $table->string('mr_number');
            $table->string('person_delay');
            $table->string('designation_delay');
            $table->integer('recover_amount');
            $table->date('date_recover_amount');
            $table->date('date_deposite_bank');
            $table->string('bank_statement_url');
            $table->date('date_of_submit');
            $table->string('year_of_submit');
            $table->string('month_of_submit');
            $table->string('request_id');
            $table->integer('approval_status')->default(0);
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
        Schema::dropIfExists('add_dc');
    }
}
