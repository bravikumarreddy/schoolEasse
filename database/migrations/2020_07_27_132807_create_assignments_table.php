<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teacher_subject_id')->unsigned();
            $table->string('path')->nullable();
            $table->string('url_path')->nullable();
            $table->string('title');
            $table->string('due_date');
            $table->string('description');
            $table->timestamps();
        });

        Schema::table('assignments', function (Blueprint $table) {

            $table->foreign('teacher_subject_id')->references("id")->on("teacher_subjects")->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
}
