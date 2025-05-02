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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 150);
            $table->boolean('vendu')->default(false);
            $table->boolean('visible')->default(true);
            $table->boolean('premiere_main')->default(false);
            $table->decimal('prix', 10, 2);
            $table->unsignedInteger('kilometrage');
            $table->unsignedSmallInteger('chevaux_fiscaux');
            $table->unsignedSmallInteger('chevaux_din');
            $table->text('description');
            $table->string('ville', 100);
            $table->char('code_postal', 5);
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('marque_id')->nullable()->constrained('marques')->nullOnDelete();
            $table->foreignId('modele_id')->nullable()->constrained('modeles')->nullOnDelete();
            $table->foreignId('energie_id')->nullable()->constrained('energies')->nullOnDelete();
            $table->foreignId('transmission_id')->nullable()->constrained('transmissions')->nullOnDelete();
            $table->foreignId('type_id')->nullable()->constrained('types')->nullOnDelete();
            $table->foreignId('porte_id')->nullable()->constrained('portes')->nullOnDelete();
            $table->foreignId('place_id')->nullable()->constrained('places')->nullOnDelete();
            $table->foreignId('couleur_id')->nullable()->constrained('couleurs')->nullOnDelete();
            $table->foreignId('condition_id')->nullable()->constrained('conditions')->nullOnDelete();
            $table->fullText(['titre', 'description', 'ville']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
