<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('department');
            $table->string('programme');
            $table->string('semester');

            $table->string('course_code');
            $table->string('course_title');
            
            $table->string('theory_cr_hrs');
            $table->string('lab_cr_hrs');

            $table->string('prerequsite_title')->nullable();
            $table->string('prerequsite_code')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}