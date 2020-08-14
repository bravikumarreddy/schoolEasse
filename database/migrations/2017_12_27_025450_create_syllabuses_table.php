<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSyllabusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syllabuses', function (Blueprint $table) {

            $table->increments('id');
            $table->string('topic');
            $table->text('reference');
            $table->integer('subject_id')->unsigned();
            $table->text('comments');
            $table->timestamps();


        });

        Schema::table('syllabuses', function (Blueprint $table) {

            $table->foreign('subject_id')->references("id")->on("subjects")->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('syllabuses');
    }
}
