<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttractionCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attraction_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('attraction_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->timestamps();

            $table->foreign('attraction_id')->references('id')->on('attractions')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attraction_category');
    }
}
