<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPresentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_presentations', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
            $table->bigInteger('iduser')->unsigned();
            $table->bigInteger('idpresentation')->unsigned();
            
            
            $table->timestamps();
            $table->softDeletes();
            
            // $table->primary(['id', 'iduser', 'idpresentation']);
            $table->unique(['iduser','idpresentation']);  
            $table->index(['idpresentation','iduser']);  
            
            $table->foreign('idpresentation')->references('id')->on('presentations')->onDelete('restrict');
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
        Schema::dropIfExists('user_presentations');
    }
}
