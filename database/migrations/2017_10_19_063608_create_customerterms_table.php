<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomertermsTable extends Migration
{

    public function up()
    {
       Schema::create('customer_terms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik');
            $table->string('name');
            $table->integer('telephone');

            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->string('city');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('customer_terms');
    }
}
