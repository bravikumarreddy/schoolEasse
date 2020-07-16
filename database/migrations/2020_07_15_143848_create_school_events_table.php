<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->integer('section_id')->unsigned()->nullable();
            $table->integer('exam_id')->unsigned()->nullable();
            $table->integer('subject_id')->unsigned()->nullable();
            $table->integer('individual_id')->unsigned()->nullable();
            $table->string('group_name')->nullable();
            $table->string('category');
            $table->string('title');
            $table->string('from');
            $table->string('to');
            $table->string('color');
            $table->timestamps();
        });

        Schema::table('school_events', function (Blueprint $table) {

            $table->foreign('school_id')->references("id")->on("schools")->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_events');
    }
}
