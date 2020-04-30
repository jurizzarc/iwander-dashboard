<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->text('description');
          $table->string('image', 100)->default('default-image.png');
          $table->string('website',100)->nullable($value = true);
          $table->string('email',50)->nullable($value = true);
          $table->string('phone', 20)->nullable($value = true);
          $table->decimal('min_price',4,2)->nullable($value = true);
          $table->decimal('max_price',4,2)->nullable($value = true);

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
        Schema::dropIfExists('details');
    }
}
