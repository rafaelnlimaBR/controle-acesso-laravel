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
        Schema::create('registros',function (Blueprint $t){
            $t->id();
            $t->text('descricao');
            $t->foreignId('tipo_id')->references('id')->on('registros_tipos')->onDelete('cascade');
            $t->foreignId('historico_id')->references('id')->on('historicos')->onDelete('cascade');
            $t->dateTime('data');
            $t->foreignId('autor_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};
