<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SliderImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('slider_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->integer('image_number')->unsigned();
            $table->string('path');
            $table->string('url_path');
            $table->string('title');
            $table->string('description');
            $table->timestamps();
        });

        Schema::table('slider_images', function (Blueprint $table) {

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
        //
    }
}
