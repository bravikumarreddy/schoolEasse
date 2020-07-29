<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("school_id")->unsigned();
            $table->string('name');
            $table->string('ph_number');
            $table->string('number');

            $table->timestamps();
        });

        Schema::table('transportations', function (Blueprint $table) {

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
        Schema::dropIfExists('transportations');
    }
}
