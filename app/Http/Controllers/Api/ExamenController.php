<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Examen;
use App\Models\ResultatExamen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $examens = Examen::with('patient', 'medecin', 'resultat')
            ->orderByRaw("FIELD(statut, 'Urgent', 'En attente', 'En cours', 'Terminé')")
            ->get();
        return self::doapi(true, "", $examens,200);
    }

    public function changerStatut(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:En attente,En cours,Terminé,Urgent',
        ]);

        $examens = Examen::findOrFail($id);
        $examens->update(['statut' => $request->statut]);

        return self::doapi(true, "Statut mis à jour", $examens, 200);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private static function doapi($succes, $message, $data=[], $satus){
        return response()->json([
            "succes"=>$succes,
            "message"=>$message,
            "data"=>$data
        ], $satus);
    }
}
