<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_structures', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->integer("school_id")->unsigned();;
            //$table->foreign('school_id')->references("id")->on("schools");
            $table->timestamps();
        });

        Schema::table('fee_structures', function (Blueprint $table) {

            $table->foreign('school_id')->references("id")->on("schools");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_structures');
    }
}
