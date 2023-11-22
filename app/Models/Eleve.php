<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;
    protected $table = 'ELEVE'; // Nom de la table associée

    protected $primaryKey = 'Matricule'; // Clé primaire de la table ELEVE
    public $incrementing = false;

    protected $fillable = [
        'Matricule',
        'NomEleve',
        'PrenomEleve',
        'Sexe',
        'DateNaissance',
        'AdresseEleve',
        'IdClasse',
        'image'
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'IdClasse');
    }

    public function faire()
    {
        return $this->hasMany(Faire::class, 'Matricule');
    }

}

