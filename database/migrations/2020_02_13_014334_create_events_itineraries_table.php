<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsItinerariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_itineraries', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('event_id')->unsigned();
          $table->bigInteger('itinerary_id')->unsigned();
          $table->timestamps();

          $table->foreign('event_id')->references('id')->on('events')->onUpdate('cascade')->onDelete('cascade');
          $table->foreign('itinerary_id')->references('id')->on('itineraries')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events_itineraries');
    }
}
