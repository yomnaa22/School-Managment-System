<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSubjectExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_subject_exam', function (Blueprint $table) {
            // $table->id();
            $table->integer('score');
            $table->foreignId('course_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->primary();
            $table->foreignId('student_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->primary();
            $table->foreignId('exam_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->primary();


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
        Schema::dropIfExists('student_subject_exam');
    }
}
