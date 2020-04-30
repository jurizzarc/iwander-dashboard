<?php
# @Author: maerielbenedicto
# @Date:   2019-10-22T00:42:50+01:00
# @Last modified by:   maerielbenedicto
# @Last modified time: 2019-10-22T00:43:31+01:00




use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_role', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('user_id')->unsigned();
          $table->bigInteger('role_id')->unsigned();
          $table->timestamps();

          $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
          $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_role');
    }
}
