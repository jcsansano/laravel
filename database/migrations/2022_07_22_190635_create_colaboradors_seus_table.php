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
        Schema::create('colaborados_seus', function (Blueprint $table) {
            $table->id();
            $table->text('notaSeuColab')->nullable();
            $table->date('baixaSeu')->nullable();
            $table->timestamps();
            //claves foraneas
            $table->foreignId('seuId')->references('id')->on('seus')->onDelete('cascade');
            $table->foreignId('colabId')->references('id')->on('colaboradors')->onDelete('cascade');
            //generacion de indice compuesto
            $table->unique(['seuId','colabId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colaborados_seus');
    }
};
