<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    use HasFactory;

    protected $table = 'ENSEIGNANT'; // Nom de la table associée
    protected $primaryKey = 'IdEnseignant';
    public $incrementing = false;

    protected $fillable = [
        'IdEnseignant',
        'NomEnseignant',
        'PrenomEnseignant',
        'AdresseEnseignant',
        'Contact',
        'IdUtilisateur',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'IdUtilisateur');
    }

    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'ENSEIGNER', 'IdEnseignant', 'IdClasse')
            ->withPivot('CodeMatiere');
    }

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'ENSEIGNER', 'IdEnseignant', 'CodeMatiere');
    }


}
