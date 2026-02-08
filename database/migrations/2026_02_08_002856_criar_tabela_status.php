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
        Schema::create('status', function (Blueprint $t) {
            $t->id('id');
            $t->string('nome')->unique();
            $t->boolean('cobrar')->default(false);
            $t->boolean('renovar_garantia')->default(false);
            $t->string('cor_fundo')->nullable();
            $t->string('cor_letra')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('status');
    }
};
