<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_marks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('marks');
            $table->integer('max_marks');
            $table->integer('subject_id')->unsigned();
            $table->integer('exam_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->string('teacher_name')->nullable();
            $table->timestamps();
        });
        Schema::table('exam_marks', function (Blueprint $table) {

            $table->foreign('subject_id')->references("id")->on("subjects")->onDelete('cascade');
            $table->foreign('exam_id')->references("id")->on("class_exams")->onDelete('cascade');
            $table->foreign('student_id')->references("id")->on("users")->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_marks');
    }
}
