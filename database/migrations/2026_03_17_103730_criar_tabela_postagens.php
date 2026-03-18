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
        Schema::create('postagens', function (Blueprint $t) {
           $t->id('id');
           $t->string('titulo');
           $t->string('titulo_link')->unique();
           $t->boolean('ativo')->default(1);
           $t->text('conteudo');
           $t->text('meta_descricao');
           $t->foreignId('imagem_id')->nullable()->references('id')->on('imagens_posts')->onDelete('set null')->onUpdate('cascade');
           $t->foreignId('autor_id')->nullable()->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
           $t->integer('visualizacoes')->default(0);

           $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postagens');
    }
};
