<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->increments('id');
            $table->string("from");
            $table->string("to");
            $table->string("reason")->nullable();
            $table->string('status');
            $table->integer('user_id')->unsigned();
            $table->string('comment')->nullable();
            $table->string('approved_by')->nullable();
            $table->timestamps();
        });

        Schema::table('leaves', function (Blueprint $table) {
            $table->foreign('user_id')->references("id")->on("users")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaves');
    }
}
