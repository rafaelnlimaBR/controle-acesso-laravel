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
        Schema::create("banners",function(Blueprint $t){
            $t->id();
            $t->string("titulo");
            $t->string('link')->nullable();
            $t->text('descricao');
            $t->boolean('ativo')->default(0);
            $t->string('imagem');
            $t->foreignId('autor_id')->nullable()->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("banners");
    }
};
