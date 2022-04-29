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
        Schema::create('seus', function (Blueprint $table) {
            $table->idSeu();
            $table->timestamps();
            $table->string('nomSeu',30)->unique();

            $table->string('correuSeu',35)->unique();
            $table->text('notesSeu')->nullable();
            $table->string('logoSeu',30)->nullable();




            $table->string('correuSeu',35)->unique();
            $table->text('notesSeu')->nullable();
            $table->string('logoSeu',30)->nullable();
            $table->timestamp('baixaSeu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seus');
    }
};
