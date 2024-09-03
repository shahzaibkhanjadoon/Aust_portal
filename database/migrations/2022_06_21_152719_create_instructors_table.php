<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->string('course_title')->nullable();
            $table->string('course_code')->nullable();
            $table->string('programme')->nullable();
            $table->string('semester')->nullable();
            $table->string('section')->nullable();
            $table->string('session')->nullable();
            $table->string('year')->nullable();
            $table->string('instructor_name')->nullable();
            $table->string('instructor_email')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructors');
    }
}
