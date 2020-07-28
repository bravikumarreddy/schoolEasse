<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assignment_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->string('description');
            $table->string('path')->nullable();
            $table->string('url_path')->nullable();
            $table->timestamps();
        });

        Schema::table('assignment_submissions', function (Blueprint $table) {

            $table->foreign('assignment_id')->references("id")->on("assignments")->onDelete('cascade');
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
        Schema::dropIfExists('assignment_submissions');
    }
}
