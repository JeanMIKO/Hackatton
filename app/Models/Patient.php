<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['numero_dossier', 'nom', 'prenom', 'date_naissance', 'sexe', 'profession', 'nom_urgence', 'telephone_urgence', 'groupe_sanguin', 'adresse', 'telephone', 'email', 'antecedents', 'allergies', 'medecin_id', 'statut'];

    public function examens(){
        return $this -> hasMany(Examen::class);
    }

    public function medecin(){
        return $this -> belongsTo(User::class);
    }

}
