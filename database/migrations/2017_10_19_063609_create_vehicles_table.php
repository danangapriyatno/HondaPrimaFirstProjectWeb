<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{

    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_stock');
            $table->string('name');
            $table->string('colour');
            $table->string('frame_no');
            $table->string('machine_no');
            $table->integer('stock');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('vehicles_type_id')->unsigned();
            $table->foreign('vehicles_type_id')->references('id')->on('vehicle_types');


            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('vehicles');
    }
}
