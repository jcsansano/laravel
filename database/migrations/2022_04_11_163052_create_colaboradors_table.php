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
            $table->string('dniColab',9)->unique();
            $table->string('nomColab', 15);
            $table->string('cognomsColab',35);
            $table->string('correuColab',35)->unique();
            $table->string('telefonColab',9)->unique();
            $table->string('fotoColab',30)->nullable();
            $table->text('notesColav')->nullable();
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
        Schema::dropIfExists('colaboradors');
    }
};
