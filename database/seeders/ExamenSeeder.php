<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('examens')->insert([
            'patient_id' => 1,
            'medecin_id' => 1,
            'type_exam' => 'creatinine',
            'date_prescription' => "2025-02-01",
            'statut' => 'En attente',
            'notifie' => true
        ]);
    }
}
