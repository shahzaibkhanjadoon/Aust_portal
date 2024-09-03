<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();

            $table->string('father_name')->nullable();
            $table->string('Gender')->nullable();
            $table->string('Nationality')->nullable();
            $table->string('CNIC')->nullable();
            $table->string('Date_of_Birth')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('Religion')->nullable();
            $table->string('profile_pic')->nullable();
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
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
