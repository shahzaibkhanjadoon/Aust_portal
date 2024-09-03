<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('department')->nullable();
            $table->string('programme')->nullable();
            $table->string('stu_name')->nullable();
            $table->string('roll_no')->nullable();
            $table->string('semester')->nullable();
            $table->string('section')->nullable();
            $table->string('session')->nullable();
            $table->string('year')->nullable();
            $table->string('course_code')->nullable();
            $table->string('course_title')->nullable();
            $table->string('theory_cr_hrs')->nullable();
            $table->string('lab_cr_hrs')->nullable();

            $table->string('assignment_1_date')->nullable();
            $table->string('assignment_1_tot_marks')->nullable();
            $table->string('assignment_1_obt_marks')->nullable();

            $table->string('assignment_2_date')->nullable();
            $table->string('assignment_2_tot_marks')->nullable();
            $table->string('assignment_2_obt_marks')->nullable();

            $table->string('assignment_3_date')->nullable();
            $table->string('assignment_3_tot_marks')->nullable();
            $table->string('assignment_3_obt_marks')->nullable();

            $table->string('assignment_4_date')->nullable();
            $table->string('assignment_4_tot_marks')->nullable();
            $table->string('assignment_4_obt_marks')->nullable();


            $table->string('quiz_1_date')->nullable();
            $table->string('quiz_1_tot_marks')->nullable();
            $table->string('quiz_1_obt_marks')->nullable();

            $table->string('quiz_2_date')->nullable();
            $table->string('quiz_2_tot_marks')->nullable();
            $table->string('quiz_2_obt_marks')->nullable();

            $table->string('quiz_3_date')->nullable();
            $table->string('quiz_3_tot_marks')->nullable();
            $table->string('quiz_3_obt_marks')->nullable();

            $table->string('quiz_4_date')->nullable();
            $table->string('quiz_4_tot_marks')->nullable();
            $table->string('quiz_4_obt_marks')->nullable();

            $table->string('mid_paper_date')->nullable();
            $table->string('mid_paper_tot_marks')->nullable();
            $table->string('mid_paper_obt_marks')->nullable();

            $table->string('final_paper_date')->nullable();
            $table->string('final_paper_tot_marks')->nullable();
            $table->string('final_paper_obt_marks')->nullable();

            $table->string('total_marks')->nullable();
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
        Schema::dropIfExists('results');
    }
}
