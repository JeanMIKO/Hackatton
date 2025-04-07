<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    protected $fillable = ['patient_id', 'medecin_id', 'type_exam', 'date_prescription', 'statut'];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function medecin(){
        return $this -> belongsTo(Medecin::class);
    }

    public function resultat(){
        return $this -> hasOne(ResultatExamen::class);
    }

}
