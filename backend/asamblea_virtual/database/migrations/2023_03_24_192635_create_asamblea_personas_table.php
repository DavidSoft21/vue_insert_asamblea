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
        Schema::create('asamblea_persona', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id');
            $table->foreignId('asamblea_id');
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('asamblea_id')->references('id')->on('asambleas');
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
        Schema::dropIfExists('asamblea_personas');
    }
};
