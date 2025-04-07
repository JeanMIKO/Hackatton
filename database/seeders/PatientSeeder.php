<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('patients')->insert([
            'numero_dossier' => "200",
            'nom' => "AGOLI",
            'prenom' => "Marc",
            'date_naissance' => "2001-01-01",
            'sexe' => 'Homme',
            'profession' => "Avocat",
            'nom_urgence' => "GBAGUIDI",
            'telephone_urgence' => "51 24 23 22",
            'groupe_sanguin' => "A",
            'adresse' => "IITA carrefour",
            'telephone' => '52 12 45 85',
            'email' => "marc@gmail.com",
            'antecedents' => "RAS",
            'allergies' => "Les moustiques",
            'medecin_id' => 1,
            'statut' => 'Actif'
        ]);
    }
}
