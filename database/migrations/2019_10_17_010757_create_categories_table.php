<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name", 50);
            $table->string("slug", 50)->unique();
            $table->unsignedBigInteger("parent")->nullable();
            $table->string("description",300);
            $table->foreign('parent')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });


    }

    /**
     * ALTER TABLE `categories` ADD CONSTRAINT `fk_parent_id` FOREIGN KEY (`parent`) REFERENCES `categories`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('categories');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
