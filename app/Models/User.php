<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject; // Ajoute cette ligne
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject // Implémente l'interface JWTSubject
{
    //use Laravel\Sanctum\HasApiTokens;
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @return string
     */
    public function getJWTIdentifier()
    {
        // Cette méthode renvoie l'identifiant unique de l'utilisateur
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        // Cette méthode renvoie des informations personnalisées à ajouter au token (par exemple, le rôle de l'utilisateur)
        return [
            'role' => $this->role,  // Exemple de claim : ajouter le rôle de l'utilisateur
        ];
    }
}
