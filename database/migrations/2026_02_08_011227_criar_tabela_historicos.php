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
        Schema::create('historicos', function (Blueprint $t) {
            $t->id('id');
            $t->foreignId('contrato_id')->references('id')->on('contratos')->onDelete('cascade');
            $t->foreignId('status_id')->references('id')->on('status')->onDelete('cascade');
            $t->foreignId('autor_id')->references('id')->on('users')->onDelete('cascade');
            $t->text('descricao')->nullable();
            $t->dateTime('data');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historicos');
    }
};
