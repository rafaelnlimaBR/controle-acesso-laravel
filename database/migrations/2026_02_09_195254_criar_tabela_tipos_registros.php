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
        Schema::create('tipos_registros', function (Blueprint $t) {
            $t->id('id');
            $t->string('nome');
            $t->boolean('compartilhavel')->default(false);
            $t->integer('altura_imagem')->default(250);
            $t->integer('largura_imagem')->default(350);
            $t->string('icon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_registros');
    }
};
