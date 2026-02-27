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
        Schema::create('entradas', function (Blueprint $t) {
            $t->id('id');
            $t->string('descricao');
            $t->decimal('valor',8,2);
            $t->dateTime('data');
            $t->foreignId('autor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $t->foreignId('taxa_id')->references('id')->on('taxas_entradas')->onDelete('cascade')->onUpdate('cascade');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
