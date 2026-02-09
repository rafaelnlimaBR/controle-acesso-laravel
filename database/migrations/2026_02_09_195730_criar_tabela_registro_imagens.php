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
        Schema::create('registros_imagens',function (Blueprint $t){
            $t->id('id');
            $t->string('nome');
            $t->foreignId('registro_id')->references('id')->on('registros')->onDelete('cascade');

            $t->text('descricao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros_imagens');
    }
};
