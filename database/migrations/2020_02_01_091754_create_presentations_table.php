<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentations', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
            $table->bigInteger('iduser')->unsigned();
            $table->string('tittle', 40);
            $table->string('video'); 
            $table->string('miniature'); 
            $table->longText('description'); 
            $table->boolean('pay'); 
            $table->string('document'); 
            $table->bigInteger('iduserPay'); 
            
            $table->timestamps();
            $table->softDeletes();
            
            // $table->primary('iduser');
             $table->foreign('iduser')->references('id')->on('users')->onDelete('restrict');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presentations');
    }
}
