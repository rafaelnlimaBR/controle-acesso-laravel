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
        Schema::create('postagem_imagens', function (Blueprint $t) {
            $t->id('id');
            $t->string('nome');
            $t->text('descricao');
            $t->boolean('ativo')->default(1);
            $t->foreignId('comentario_id')->references('id')->on('comentarios')->onDelete('cascade')->onUpdate('cascade');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postagem_imagens');
    }
};
