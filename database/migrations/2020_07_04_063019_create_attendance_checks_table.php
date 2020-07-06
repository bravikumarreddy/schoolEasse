<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_checks', function (Blueprint $table) {
            $table->increments('id');

            $table->integer("user_id")->unsigned();
            $table->integer('section_id')->unsigned();
            $table->string("date");
            $table->string("session");
            $table->timestamps();
        });

        Schema::table('attendance_checks', function (Blueprint $table) {

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
        Schema::dropIfExists('attendance_checks');
    }
}
