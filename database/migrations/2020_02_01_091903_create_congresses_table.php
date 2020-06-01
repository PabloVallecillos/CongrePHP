<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCongressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('congresses', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
             $table->bigInteger('iduser')->unsigned();
            $table->string('tittle', 40)->unique();
            $table->string('thematic', 10)->unique();
            $table->decimal('price','8','2');
            $table->date('date');
            
            // $table->primary(['id', 'iduser', 'idpresentation']);
            
            $table->timestamps();
            $table->softDeletes();
            
            //  $table->foreign('iduser')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('congresses');
    }
}
