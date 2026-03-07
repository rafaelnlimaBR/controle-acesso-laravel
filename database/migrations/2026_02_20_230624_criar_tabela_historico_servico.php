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
        Schema::create('historico_servico', function (Blueprint $t) {
            $t->id('id');
            $t->foreignId('servico_id')->references('id')->on('servicos')->onDelete('cascade')->onUpdate('cascade');
            $t->foreignId('historico_id')->references('id')->on('historicos')->onDelete('cascade')->onUpdate('cascade');
            $t->decimal('valor_liquido', 8, 2);
            $t->decimal('valor_bruto', 8, 2);
            $t->decimal('desconto', 8, 2)->default(0);
            $t->boolean('cobrar')->default(false);
            $t->boolean('devolucao')->default(false);
            $t->unique(['servico_id', 'historico_id']);
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico_servico');
    }
};
