<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordChangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_change', function (Blueprint $table) {
            $table->id();
            $table->integer('e_id');
            $table->string('secret_key');
            $table->date('recive_date');
            $table->time('recive_time');
            $table->string('temp_password');
            $table->integer('apply')->nullable();
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
        Schema::dropIfExists('password_change');
    }
}
