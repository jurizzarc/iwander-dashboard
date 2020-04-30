<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttractionIdAndItineraryIdColumnsToBookmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookmarks', function (Blueprint $table) {
          $table->bigInteger('attraction_id')->unsigned()->nullable();
          $table->bigInteger('itinerary_id')->unsigned()->nullable();

          $table->foreign('attraction_id')->references('id')->on('attractions')->onUpdate('cascade')->onDelete('cascade');
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

      Schema::table('bookmarks', function (Blueprint $table) {
        $table->dropForeign(['attraction_id']);
        $table->dropColumn('attraction_id');

        $table->dropForeign(['itinerary_id']);
        $table->dropColumn('itinerary_id');
      });
    }
}
