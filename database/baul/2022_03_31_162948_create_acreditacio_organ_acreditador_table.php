<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acreditacions_organ_acreditador', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('organAcred_id')->unsigned();
            $table->bigInteger('acreditacio_id')->unsigned();
            $table->foreign('acreditacio_id')->references('id')->on('acreditacions');
            $table->foreign('organAcred_id')->references('id')->on('organsAcreditadors');
            //$table->unique(['organAcred_id','acreditacio_id']);
            $table->timestamps();
      
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acreditacions_organ_acreditador');
    }
};
