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
        Schema::create('acreditacions_colaboradors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('id_seu')->unsigned();
            $table->integer('id_acreditacio')->unsigned();
            $table->integer('id_colaborador')->unsigned();
            $table->foreign('id_seu')->references('id')->on('seus');
            $table->foreign('id_acreditacio')->references('id')->on('acreditacions');
            $table->foreign('id_colaborador')->references('id')->on('colaboradors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acreditacions_colaboradors');
    }
};
