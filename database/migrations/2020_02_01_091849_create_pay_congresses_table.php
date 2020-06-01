<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayCongressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_congresses', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
            $table->bigInteger('iduser')->unsigned();
            $table->bigInteger('idpresentation')->unsigned();
            $table->string('document')->nullable();
            $table->boolean('check');
            
            $table->timestamps();
            $table->softDeletes();
            
            // $table->primary('iduser');
            $table->foreign('iduser')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('idpresentation')->references('id')->on('presentations')->onDelete('restrict');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pay_congresses');
    }
}
