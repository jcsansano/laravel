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
        Schema::create('colaboradors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //$table->integer('id_seu')->unsigned();
            $table->string('nifColab',9)->unique(); 
            $table->string('nomColab', 30);
            $table->string('cognomsColab',50);
            $table->string('correuColab',35)->unique();
            $table->string('telefonColab',9)->unique();
            $table->string('fotoColab',30)->nullable();
            $table->text('notesColav')->nullable();
            //$table->foreing('id_seu')->references('id')->on('seus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colaboradors');
    }
};
