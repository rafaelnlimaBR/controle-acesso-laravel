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
        Schema::create('comentario_resposta', function (Blueprint $t) {
            $t->id();
            $t->foreignId('comentario_id')->references('id')->on('comentarios')->onDelete('cascade')->onUpdate('cascade');
            $t->foreignId('resposta_id')->references('id')->on('comentarios')->onDelete('cascade')->onUpdate('cascade');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentario_resposta');
    }
};
