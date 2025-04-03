<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\UserCredentialsMail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validation des données entrées
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:Administrateur,Médecin,Laborantin',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        // Envoi des informations par email
        Mail::to($user->email)->send(new UserCredentialsMail($user, $request->password));

        return response()->json([
            'message' => 'Utilisateur inscrit avec succès',
            'user' => $user
        ], 201);
    }


    public function login(Request $request)
    {
        // Valider les données envoyées
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Trouver l'utilisateur
        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || !\Hash::check($validatedData['password'], $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Création du token avec une expiration
        try {
            // Création du token JWT avec les paramètres de configuration par défaut
            $token = JWTAuth::fromUser($user);

            // Récupérer la valeur d'expiration depuis la configuration
            // Notez que vous avez deux configurations : 'ttl' (60 minutes par défaut) et 'expire' (1440 minutes)
            $expirationInMinutes = config('jwt.ttl', 1440); // Utilise 'expire' ou la valeur par défaut 1440 (24h)
            $expirationInSeconds = $expirationInMinutes * 60;

            return response()->json([
                'token' => $token,
                'expires_in' => $expirationInSeconds // Durée d'expiration en secondes
            ]);
        } catch (JWTException $e) {
            Log::error("Erreur lors de la création du jeton JWT : " . $e->getMessage());
            return response()->json(['error' => 'Could not create token'], 500);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Déconnexion réussie']);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password
        ]);

        return response()->json(['message' => 'Informations mises à jour avec succès', 'user' => $user]);
    }

}
