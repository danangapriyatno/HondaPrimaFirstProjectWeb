<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountOtrVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_otr_vehicles', function (Blueprint $table) {
           $table->increments('id');
            $table->integer('discount');
            $table->string('otr');
            $table->integer('vehicles_id')->unsigned();
            $table->foreign('vehicles_id')->references('id')->on('vehicles');
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
        Schema::drop('discount_otr_vehicles');
    }
}
