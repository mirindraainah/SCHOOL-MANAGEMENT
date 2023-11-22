<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'IdUtilisateur',
        'name',
        'email',
        'role',
        'password',
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $primaryKey = 'IdUtilisateur';
    public $incrementing = false;

    public function enseignant()
    {
        return $this->hasOne(Enseignant::class, 'IdUtilisateur');
    }


    // Vérification rôle
    public function isAdmin()
    {
        return $this->role === 'administrateur'; // rôle d'administrateur dans la base de données.
    }

    public function isProfessor()
    {
        return $this->role === 'professeur'; // rôle d'administrateur dans la base de données.
    }
}
