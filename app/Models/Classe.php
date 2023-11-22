<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Matiere;


class Classe extends Model
{
    use HasFactory;
    
    protected $table = 'CLASSE';
    protected $primaryKey = 'IdClasse'; // Clé primaire de la table CLASSE

    protected $fillable = [
        'NomClasse',
    ];

    public $timestamps = false; // Désactiver le suivi des dates

    public function eleves()
    {
        return $this->hasMany(Eleve::class, 'IdClasse');
    }

    public function enseigner()
    {
        return $this->belongsToMany(Matiere::class, 'ENSEIGNER', 'IdClasse', 'CodeMatiere')
            ->withPivot('IdEnseignant');
    }

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'ENSEIGNER', 'IdClasse', 'CodeMatiere')
            ->withPivot('IdEnseignant');
    }

    public function enseignants()
    {
        return $this->belongsToMany(Enseignant::class, 'ENSEIGNER', 'IdClasse', 'IdEnseignant')
            ->withPivot('CodeMatiere');
    }
}
