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
        Schema::create('pecas_avulsas', function ($t) {
            $t->id('id');
            $t->string('nome');
            $t->string('marca')->nullable();
            $t->decimal('valor_bruto',8,2)->default(0);
            $t->decimal('valor_liquido',8,2)->default(0);
            $t->boolean('cobrar')->default(false);
            $t->integer('qnt')->default(0);
            $t->boolean('devolver')->default(false);
            $t->decimal('desconto',8,2)->default(0);
            $t->foreignId('historico_id')->references('id')->on('historicos')->onDelete('cascade')->onUpdate('cascade');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pecas_avulsas');
    }
};
