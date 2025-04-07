<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultatExamen extends Model
{
    protected $fillable = ['examen_id', 'laborantin_id', 'nom_examen', 'resultats', 'remarque', 'date_realisation'];

    public function examen(){
        return $this -> belongsTo(Examen::class);
    }

    public function laborantin(){
        return $this -> belongsTo(User::class);
    }
}
