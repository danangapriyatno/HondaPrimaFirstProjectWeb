<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresalesTable extends Migration
{
 /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presale_uploads', function(Blueprint $table)
        {
            $table->increments('id');
       
            $table->string('filename');
            $table->string('mime');
            $table->string('original_filename');

            $table->integer('presale_id')->unsigned();
            $table->foreign('presale_id')->references('id')->on('presales');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('presale_uploads');
    }
}
