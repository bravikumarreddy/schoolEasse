<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer("school_id")->unsigned();
            $table->string('room_type');
            $table->integer('beds');
            $table->float('cost');
            $table->timestamps();
        });

        Schema::table('hostels', function (Blueprint $table) {

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
        Schema::dropIfExists('hostels');
    }
}
