<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('department')->nullable();
            $table->string('programme')->nullable();
            $table->string('stu_name')->nullable();
            $table->string('roll_no')->nullable();
            $table->string('semester')->nullable();
            $table->string('section')->nullable();
            $table->string('session')->nullable();
            $table->string('year')->nullable();
            $table->string('course_title')->nullable();
            $table->string('date')->nullable();
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
        Schema::dropIfExists('attendances');
    }
}
