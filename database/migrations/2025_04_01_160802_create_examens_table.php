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
        Schema::create('examens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('medecin_id')->constrained('medecins')->onDelete('cascade');
            $table->foreignId('laborantin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('type_exam', ['nfs', 'uremie', 'creatinine', 'ionogramme', 'cholesterol', 'triglycerides', 'glycemie', 'hemoglobine_glyquee', 'autres']);
            $table->string('code_examen')->unique();
            $table->date('date_prescription');
            $table->date('date_realisation')->nullable();
            $table->text('resultat')->nullable();
            $table->text('commentaires')->nullable();
            $table->enum('statut', ['En attente', 'En cours', 'Terminé', 'Urgent'])->default('En attente');
            $table->string('fichier')->nullable();
            $table->boolean('notifie')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examens');
    }
};
