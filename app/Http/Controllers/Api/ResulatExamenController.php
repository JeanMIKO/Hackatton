<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Examen;
use App\Models\ResultatExamen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResulatExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resultat_examens = ResultatExamen::with('examen', 'laborantin')->get();
        return self::doapi(true, "", $resultat_examens, 200);
    }

    /**
     * Store a newly created resource in storage.
     */

      public function create()
     {
        $examens = Examen::select('id', 'type_exam')->get();
        $laborantins = User::select('id', 'name')->get();

        return self::doapi(true, "Votre résultat d'analyse a été créé avec succès", [$examens, $laborantins], 200);
     }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'examen_id' => 'required|numeric',
            'laborantin_id' =>'required|numeric',
            'nom_examen' => 'required|text|max:255',
            'resultats' => 'required|text|max:300',
            'remarque' => 'required|numeric',
            'date_realisation' => 'required|text|max:300',
        ]);

        if ($validator->fails()){
            return response()->json(["message"=>$validator->getMessageBag()->first()], 400);
        }

        $creation=ResultatExamen::create($request->all());
        return self::doapi(true, "Votre resultat d'examen a été créé avec succès",$creation, 200);
        //return response()->json(['message' => 'Test OK'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'examen_id' => 'required|numeric',
            'laborantin_id' =>'required|numeric',
            'nom_examen' => 'required|text|max:255',
            'resultats' => 'required|text|max:300',
            'remarque' => 'required|numeric',
            'date_realisation' => 'required|text|max:300',

        ]);

        if ($validator->fails()){
            return response()->json(["message"=>$validator->getMessageBag()->first()], 400);
        }

        $resultat_examens = ResultatExamen::findOrFail($id);
        $resultat_examens->update($request->all());

        return self::doapi(true, "Les résultats a ete modifie avec succès", $resultat_examens, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resultat_examens = ResultatExamen::findOrFail($id);
        $resultat_examens->delete();

        return self::doapi(true, "votre résultat a été supprimé avec succès", $resultat_examens, 200);
    }

    private static function doapi($succes, $message, $data=[], $satus){
        return response()->json([
            "succes"=>$succes,
            "message"=>$message,
            "data"=>$data
        ], $satus);
    }
}
