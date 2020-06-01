<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPdfPresentationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_pdf_presentation', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');

            $table->bigInteger('iduser')->unsigned();
            $table->bigInteger('idpresentation')->unsigned();
            
            $table->foreign('iduser')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('idpresentation')->references('id')->on('presentations')->onDelete('cascade');
            
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
        Schema::dropIfExists('user_pdf_presentations');
    }
}
