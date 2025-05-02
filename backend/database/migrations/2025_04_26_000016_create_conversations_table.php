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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annonce_id')->constrained()->cascadeOnDelete();
            $table->foreignId('acheteur_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('vendeur_id')->constrained('users')->cascadeOnDelete();
            $table->timestamp('last_message_at')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
