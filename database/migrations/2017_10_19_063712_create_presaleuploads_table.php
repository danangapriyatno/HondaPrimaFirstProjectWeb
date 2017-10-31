<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresaleuploadsTable extends Migration
{

    public function up()
    {
        
         Schema::create('presales', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('payment');
            $table->string('otr');
            $table->string('down_payment');
            $table->string('discount');
            $table->string('leasing');
            $table->string('installment');
            $table->string('tenor');
            $table->string('program');
            $table->integer('presales_no');
            $table->integer('vehicle_id')->unsigned();
            $table->foreign('vehicle_id')->references('id')->on('vehicles');

            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('presales');
    }
}
