<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_systems', function (Blueprint $table) {

          $table->increments('id');
          $table->string('grade_system_name');
          $table->integer('school_id')->unsigned();
          $table->timestamps();

        });

        Schema::create('grade_systems_field', function (Blueprint $table) {
            $table->integer('grade_system_id')->unsigned();
            $table->string('grade');
            $table->float('from');
            $table->float('to');
            $table->timestamps();
        });

        Schema::table('grade_systems', function (Blueprint $table) {

            $table->foreign('school_id')->references("id")->on("schools")->onDelete('cascade');

        });

        Schema::table('grade_systems_field', function (Blueprint $table) {

            $table->foreign('grade_system_id')->references("id")->on("grade_systems")->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grade_systems');
    }
}
