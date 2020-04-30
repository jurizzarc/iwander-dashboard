<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address1', 255);
            $table->string('address2')->nullable($value = true);
            $table->string('address3')->nullable($value = true);
            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('district_id')->nullable($value = true)->unsigned();
            $table->string('postal_code', 50)->nullable($value = true);
            $table->bigInteger('country_id')->unsigned();
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onUpdate('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
