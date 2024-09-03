<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_courses', function (Blueprint $table) {
            $table->id();
            $table->string('department');
            $table->string('programme');
            $table->string('student_name');
            $table->string('roll_no');
            $table->string('semester');
            $table->string('section');
            $table->string('session');
            $table->string('year');
            $table->string('course_title');
            $table->string('course_code');
            $table->string('theory_cr_hrs');
            $table->string('lab_cr_hrs');
            $table->string('status')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_courses');
    }
}
