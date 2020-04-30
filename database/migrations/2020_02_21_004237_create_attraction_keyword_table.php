<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttractionKeywordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attraction_keyword', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('attraction_id')->unsigned();
          $table->bigInteger('keyword_id')->unsigned();
          $table->timestamps();

          $table->foreign('attraction_id')->references('id')->on('attractions')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('keyword_id')->references('id')->on('keywords')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attraction_keyword');
    }
}
