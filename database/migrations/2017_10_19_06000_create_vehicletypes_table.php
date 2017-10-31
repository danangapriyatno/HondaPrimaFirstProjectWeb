<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicletypesTable extends Migration
{

     public function up()
    {
        
        Schema::create('vehicle_types', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('vehicles_name');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('vehicle_types');
    }
}
