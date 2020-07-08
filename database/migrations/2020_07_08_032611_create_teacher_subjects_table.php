<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subject_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->integer('teacher_id')->unsigned();
            $table->string('teacher_name');
            $table->timestamps();
        });
        Schema::table('teacher_subjects', function (Blueprint $table) {

            $table->foreign('subject_id')->references("id")->on("subjects")->onDelete('cascade');
            $table->foreign('teacher_id')->references("id")->on("users")->onDelete('cascade');
            $table->foreign('section_id')->references("id")->on("sections")->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_subjects');
    }
}
