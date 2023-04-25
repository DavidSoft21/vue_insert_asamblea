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
        Schema::create('opcion_temario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('temario_id');
            $table->foreignId('opcion_id');
            $table->foreign('temario_id')->references('id')->on('temarios');
            $table->foreign('opcion_id')->references('id')->on('opciones');
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
        Schema::dropIfExists('opcion_temarios');
    }
};
