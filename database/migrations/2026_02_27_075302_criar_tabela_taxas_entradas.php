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
        Schema::create('taxas_entradas', function (Blueprint $t) {
            $t->id('id');
            $t->string('nome');
            $t->integer('vezes')->default(0);
            $t->decimal('taxa')->default(0);
            $t->foreignId('dado_bancario_id')->nullable()->references('id')->on('dados_bancarios')->onDelete('set null')->onUpdate('cascade');
            $t->foreignId('tipo_id')->references('id')->on('tipos_entradas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxas_entradas');
    }
};
