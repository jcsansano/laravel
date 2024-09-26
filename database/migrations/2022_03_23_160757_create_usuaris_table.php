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
        Schema::create('usuaris', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->sting('NIFUsuari', 9)->unique();
            $table->enum('perfilUsuari',['Administrador','Col·laborador','Responsable']);
            $table->string('passwdUsuari',250);
            $table->enum('nomUsuari', 9);
            $table->enum('cognomsUsuari', 25);
            $table->enum('telefonUsuari', 9)->nullable();
            $table->string('correuUsuari',35);
            $table->string('fotoUsuari',50)->nullable();
            $table->text('notesUsuari')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuari');
    }
};
