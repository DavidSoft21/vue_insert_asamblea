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
        Schema::create('formularios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id');
            $table->foreignId('temario_id');
            $table->foreignId('opciones_id');//respuesta usuario
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('temario_id')->references('id')->on('temarios');
            $table->foreign('opciones_id')->references('id')->on('opciones');
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
        Schema::dropIfExists('formularios');
    }
};
