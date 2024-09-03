<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassedStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passed_students', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            

            $table->string('father_name')->nullable();
            $table->string('Gender')->nullable();
            $table->string('Nationality')->nullable();
            $table->string('CNIC')->nullable();
            $table->string('Date_of_Birth')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('Religion')->nullable();
            $table->string('roll_no')->nullable();

            $table->string('Admission_date')->nullable();
            $table->string('ssc_degree_name')->nullable();
            $table->string('ssc_board_name')->nullable();
            $table->string('ssc_total_marks')->nullable();
            $table->string('ssc_obt_marks')->nullable();
            $table->string('hssc_degree_name')->nullable();
            $table->string('hssc_board_name')->nullable();
            $table->string('hssc_total_marks')->nullable();
            $table->string('hssc_obt_marks')->nullable();

            $table->string('city')->nullable();
            $table->string('mailing_adress')->nullable();
            $table->string('domicile_district')->nullable();
            $table->string('domicile_province')->nullable();

            $table->string('programme')->nullable();
            $table->string('session')->nullable();
            $table->string('year')->nullable();
            $table->string('semester')->nullable();
            $table->string('section')->nullable();
            $table->string('cgpa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passed_students');
    }
}
