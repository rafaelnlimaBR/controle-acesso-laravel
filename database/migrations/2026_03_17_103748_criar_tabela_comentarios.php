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
        Schema::create('comentarios', function (Blueprint $t) {
            $t->id('id');
            $t->text('conteudo');
            $t->foreignId('cliente_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $t->boolean('ativo')->default(1);
            $t->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
