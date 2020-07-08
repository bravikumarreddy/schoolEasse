<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_id')->unsigned();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('subjects', function (Blueprint $table) {

            $table->foreign('class_id')->references("id")->on("classes")->onDelete('cascade');


        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
