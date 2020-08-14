<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyllabusStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syllabus_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teacher_subject_id')->unsigned();
            $table->integer('syllabus_id')->unsigned();
            $table->tinyInteger('status');
            $table->timestamps();

        });
        Schema::table('syllabus_statuses', function (Blueprint $table) {

            $table->foreign('teacher_subject_id')->references("id")->on("teacher_subjects")->onDelete('cascade');
            $table->foreign('syllabus_id')->references("id")->on("syllabuses")->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('syllabus_statuses');
    }
}
