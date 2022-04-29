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
        Schema::create('acreditacions', function (Blueprint $table) {
            $table->id();
            $table->string('nomAcredit', 35);
            //$table->date('dataAcredit');
            $table->tinyInteger('pesAcredit')->unsigned();
            $table->text('notesAcredit')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('acreditacions');
    }
};
