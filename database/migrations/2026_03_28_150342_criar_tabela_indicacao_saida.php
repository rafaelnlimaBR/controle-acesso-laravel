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
        Schema::create('indicacao_saida', function (Blueprint $t) {
            $t->id();
            $t->foreignId('indicacao_id')->references('id')->on('indicacoes')->onDelete('cascade')->onUpdate('cascade');
            $t->foreignId('saida_id')->references('id')->on('saidas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicacao_saida');
    }
};
