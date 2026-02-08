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
        Schema::create('status_proximos', function (Blueprint $t ) {
           $t->id('id');
           $t->foreignId('atual_status_id')->references('id')->on('status')->onDelete('cascade');
           $t->foreignId('proximo_status_id')->references('id')->on('status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_proximos');
    }
};
