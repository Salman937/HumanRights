<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserComplaintRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_complaint_register', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('complaint_type');
            $table->string('sub_complaint_type');
            $table->string('subject');
            $table->string('details');
            $table->string('dept_name');
            $table->string('person_phone_number');
            $table->string('location');
            $table->string('person_email');
            $table->string('person_address');
            $table->string('image');
            $table->string('video');
            $table->string('audio');
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
        Schema::dropIfExists('user_complaint_register');
    }
}
