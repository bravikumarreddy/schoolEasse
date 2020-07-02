<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('fee_groups', function (Blueprint $table) {

            $table->increments('id');
            $table->integer("school_id")->unsigned();
            $table->string("name");
            $table->timestamps();

        });

        Schema::table('fee_groups', function (Blueprint $table) {

            $table->foreign('school_id')->references("id")->on("schools")->onDelete('cascade');

        });
        Schema::table('fee_structures', function (Blueprint $table) {

            $table->foreign('fee_group_id')->references("id")->on("fee_groups")->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_groups');
    }
}
