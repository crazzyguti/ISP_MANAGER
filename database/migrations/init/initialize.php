<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstName', 20);
            $table->string('lastName', 20);
            $table->string('email_phone', 200)->unique();
            $table->date("birthday");
            $table->string("gender", 6);
            $table->string('password', 200);
            $table->unsignedBigInteger("locate")->nullable();
            $table->timestamp("email_verified_at")->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email_phone')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop("users");
        Schema::drop("password_resets");

    }
}
