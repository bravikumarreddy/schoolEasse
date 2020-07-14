<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_tables', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('section_id')->unsigned();
            $table->integer('teacher_id')->unsigned();
            $table->integer('day_of_the_week')->unsigned();
            $table->integer('teacher_subjects_id')->unsigned();
            $table->string('from');
            $table->string('to');
            $table->timestamps();
        });
        Schema::table('time_tables', function (Blueprint $table) {

            $table->foreign('teacher_subjects_id')->references("id")->on("teacher_subjects")->onDelete('cascade');
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
        Schema::dropIfExists('time_tables');
    }
}
