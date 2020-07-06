<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->string('session');
            $table->string('date');
            $table->integer('section_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('daily_attendances', function (Blueprint $table) {

            $table->foreign('student_id')->references("id")->on("users")->onDelete('cascade');
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
        Schema::dropIfExists('daily_attendances');
    }
}
