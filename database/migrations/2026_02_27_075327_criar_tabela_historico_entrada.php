<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('historico_entrada', function (Blueprint $t) {
            $t->id('id');
            $t->foreignId('entrada_id')->references('id')->on('entradas')->onDelete('cascade')->onUpdate('cascade');
            $t->foreignId('historico_id')->references('id')->on('historicos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico_entrada');
    }
};
