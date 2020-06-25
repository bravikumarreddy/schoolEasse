<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentInstalmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_instalments', function (Blueprint $table) {
            $table->id();
            $table->integer("student_id")->unsigned();
            $table->integer("fee_structure_id")->unsigned();
            $table->foreignId("instalment_id");
            $table->boolean("paid");
            $table->timestamps();

        });
        Schema::table('student_instalments', function (Blueprint $table) {

            $table->foreign('fee_structure_id')->references("id")->on("fee_structures")->onDelete('cascade');;
            $table->foreign('instalment_id')->references("id")->on("instalments")->onDelete('cascade');;
            $table->foreign('student_id')->references("id")->on("users")->onDelete('cascade');;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_instalments');
    }
}
