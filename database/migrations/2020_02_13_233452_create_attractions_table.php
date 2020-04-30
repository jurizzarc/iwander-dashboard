<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attractions', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name',255);
          $table->bigInteger('detail_id')->unsigned();
          $table->bigInteger('address_id')->unsigned();
          $table->string('rec_duration', 50);
          $table->timestamps();

          $table->foreign('detail_id')->references('id')->on('details')->onDelete('cascade');
          $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('attractions');
        Schema::disableForeignKeyConstraints();
        Schema::drop('attractions');
        Schema::enableForeignKeyConstraints();
    }
}
