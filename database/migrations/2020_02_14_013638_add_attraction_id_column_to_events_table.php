<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttractionIdColumnToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
          $table->bigInteger('attraction_id')->unsigned()->nullable();

          $table->foreign('attraction_id')->references('id')->on('attractions')->onUpdate('cascade')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('events', function (Blueprint $table) {
        $table->dropForeign(['attraction_id']);
        $table->dropColumn('attraction_id');
      });
        // Schema::table('events', function (Blueprint $table) {
        //   $table->dropColumn('attraction_id');
        // });
    }
}
