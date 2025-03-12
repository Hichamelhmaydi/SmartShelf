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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rayon_id')->constrained()->onDelete('cascade');
            $table->string('nom');
            $table->integer('prix');
            $table->integer('quantite');
            $table->enum('status', ['en promotion', 'non promotion'])->default('non promotion');
            $table->integer('prix_promotion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
