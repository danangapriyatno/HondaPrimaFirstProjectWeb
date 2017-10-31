<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{

    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik');
            $table->string('name');
            $table->integer('telephone');
            $table->string('city');
            $table->integer('type_id');
            $table->timestamps();
        });
        
    }


    public function down()
    {
        
        Schema::drop('customers');
    }
}
