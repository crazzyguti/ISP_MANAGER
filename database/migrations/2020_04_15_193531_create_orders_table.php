<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("CustomerID");
            $table->unsignedBigInteger("EmployeeID");
            $table->unsignedBigInteger("localeID");
            $table->foreign('CustomerID')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('EmployeeID')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('LocaleID')->references('id')->on('locations')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
