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
        Schema::create('contratos', function (Blueprint $t) {
            $t->id('id');
            $t->text('descricao_cliente')->nullable();
            $t->text('observacao')->nullable();
            $t->text('solucao')->nullable();
            $t->dateTime('data_inicio');
            $t->dateTime('data_garantia')->nullable();
            $t->foreignId('criador_id')->nullable()->references('id')->on('users')->nullOnDelete();
            $t->foreignId('tecnico_id')->nullable()->references('id')->on('users')->nullOnDelete();
            $t->foreignId('cliente_id')->references('id')->on('users');
            $t->foreignId('veiculo_id')->nullable()->references('id')->on('veiculos')->nullOnDelete();
            $t->boolean('desconto_peca')->default(0);
            $t->boolean('desconto_servico')->default(0);
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
