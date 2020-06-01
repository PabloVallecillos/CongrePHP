<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePdfDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdf_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            
            $table->bigIncrements('id');
            $table->bigInteger('iduser')->unsigned();
            $table->string('first_name', 20);
            $table->string('last_name', 40);
            $table->integer('card');
            $table->string('email');
            $table->integer('phone');
            
            $table->foreign('iduser')->references('id')->on('users')->onDelete('restrict');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pdf_details');
    }
}
