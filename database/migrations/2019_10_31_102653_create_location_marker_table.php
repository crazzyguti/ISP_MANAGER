<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationMarkerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_marker', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("location_id");
            $table->unsignedBigInteger("marker_id");
            $table->timestamps();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade')->onUpdate("cascade");;
            $table->foreign('marker_id')->references('id')->on('markers')->onDelete('cascade')->onUpdate("cascade");;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('location_marker');
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
