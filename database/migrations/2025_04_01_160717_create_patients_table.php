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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('numero_dossier')->unique()->nullable();
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->enum('sexe', ['Homme', 'Femme']);
            $table->string('profession');
            $table->string('nom_urgence')->nullable();
            $table->string('telephone_urgence')->nullable();
            $table->string('groupe_sanguin')->nullable();
            $table->text('adresse');
            $table->string('telephone');
            $table->string('email')->nullable();
            $table->text('antecedents')->nullable();
            $table->text('allergies')->nullable();
            $table->foreignId('medecin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('statut', ['Actif', 'Inactif', 'Décédé'])->default('Actif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
