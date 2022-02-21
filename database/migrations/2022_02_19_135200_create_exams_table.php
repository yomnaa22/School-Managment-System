<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('max_score');

            $table->foreignId('course_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            // $table->unsignedBigInteger('course_id');
            // $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade')->onDelete('cascade');
            //$table->foreignId('questions_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            // $table->unsignedBigInteger('questions_id');
            // $table->foreign('questions_id')->references('id')->on('questions')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('exams');
    }
}
