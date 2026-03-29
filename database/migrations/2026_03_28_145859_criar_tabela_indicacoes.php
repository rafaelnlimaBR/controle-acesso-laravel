<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('indicacoes', function (Blueprint $t) {
            $t->id('id');
            $t->text('descricao');
            $t->decimal('valor',8,2)->default(0.00);
            $t->foreignId('fornecedor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $t->foreignId('historico_id')->references('id')->on('historicos')->onDelete('cascade')->onUpdate('cascade');
            $t->date('data');
            $t->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('indicacoes');
    }
};
