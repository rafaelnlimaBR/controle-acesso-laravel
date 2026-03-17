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
        Schema::create('categoria_postagem', function (Blueprint $t) {
            $t->id('id');
            $t->foreignId('categoria_id')->references('id')->on('categorias')->onDelete('cascade')->onUpdate('cascade');
            $t->foreignId('postagem_id')->references('id')->on('postagens')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_postagem');
    }
};
