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
        Schema::create('configuracoes', function (Blueprint $t) {
            $t->id('id');
            $t->string('nome_simples')->nullable();
            $t->string('nome_completo')->nullable();
            $t->string('email')->nullable();
            $t->string('whatsapp')->nullable();
            $t->string('endereco')->nullable();
            $t->string('bairro')->nullable();
            $t->string('cidade')->nullable();
            $t->string('estado')->nullable();
            $t->string('cep')->nullable();
            $t->string('cnpj')->nullable();
            $t->string('instagran')->nullable();
            $t->foreignId('grupo_admin_id')->references('id')->on('grupos')->onDelete('cascade')->onUpdate('cascade');
            $t->foreignId('grupo_tecnico_id')->references('id')->on('grupos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracoes');
    }
};
