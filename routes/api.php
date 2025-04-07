<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExamenController;
use App\Http\Controllers\Api\ResulatExamenController;
use App\Models\ResultatExamen;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/* Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/update', [AuthController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/examens', [ExamenController::class, 'index']);
    Route::get('/examens/{id}', [ExamenController::class, 'show']);
    Route::post('/examens', [ExamenController::class, 'store']);
    Route::patch('/examens/{id}/statut', [ExamenController::class, 'changerStatut']);
    Route::post('/examens/{id}/resultats', [ExamenController::class, 'ajouterResultat']);
});
 */
    Route::get('/examens', [ExamenController::class, 'index']);
    Route::patch('/examens/{id}', [ExamenController::class, 'changerStatut']);

    Route::get('/resultat_examens', [ResulatExamenController::class, 'index']);
    Route::get('/resultat_examens/create', [ResulatExamenController::class, 'create']);
    Route::post('/resultat_examens', [ResulatExamenController::class, 'store']);
    Route::patch('/resultat_examens/{id}', [ResulatExamenController::class, 'update']);
    Route::delete('/resultat_examens/{id}', [ResulatExamenController::class, 'destroy']);

