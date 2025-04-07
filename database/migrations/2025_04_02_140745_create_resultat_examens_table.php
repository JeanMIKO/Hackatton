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
        Schema::create('resultat_examens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('examen_id')->constrained('examens')->onDelete('cascade');
            $table->foreignId('laborantin_id')->constrained('users')->onDelete('cascade');
            $table->text('nom_examen');
            $table->text('resultats');
            $table->enum('remarque', ['Valeur basse', 'Valeur normale', 'Valeur élevé'])->default('Valeur normale');
            $table->date('date_realisation');
            // $table->string('fichier')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultat_examens');
    }
};
