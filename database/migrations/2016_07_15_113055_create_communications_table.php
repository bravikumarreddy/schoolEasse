<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communications', function (Blueprint $table) {
            $table->increments( 'id' );
            $table->string('message',1500);
            $table->integer('school_id')->unsigned();
            $table->integer('sender_id')->unsigned();
            $table->string('category');
            $table->string('title');
            $table->timestamps();
        });



        Schema::table('communications', function (Blueprint $table) {

            $table->foreign('school_id')->references("id")->on("schools")->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('communications');
    }
}
