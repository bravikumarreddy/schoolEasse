<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeStructureRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_structure_records', function (Blueprint $table) {
            $table->integer("fee_structure_id")->unsigned();;
            $table->string("name");
            $table->decimal("amount",19,4);
            //$table->foreign('fee_structure_id')->references("id")->on("fee_structure");
            $table->timestamps();

        });

        Schema::create('instalments', function (Blueprint $table) {
            $table->integer("fee_structure_id")->unsigned();;
            $table->integer("number");
            $table->string("due_date");
            $table->timestamps();

        });
        Schema::table('instalments', function (Blueprint $table) {

            $table->foreign('fee_structure_id')->references("id")->on("fee_structures")->onDelete('cascade');;

        });
        Schema::table('fee_structure_records', function (Blueprint $table) {

            $table->foreign('fee_structure_id')->references("id")->on("fee_structures")->onDelete('cascade');;


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_structure_records');
    }
}
