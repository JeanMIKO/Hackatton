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
        Schema::create('medicaments', function (Blueprint $table) {
            $table->id();
            $table->string('nom_commercial');
            $table->string('dci');
            $table->string('forme');
            $table->string('dosage');
            $table->text('indications');
            $table->text('contre_indications');
            $table->text('effets_secondaires');
            $table->string('classe_therapeutique');
            $table->string('code_atc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicaments');
    }
};
