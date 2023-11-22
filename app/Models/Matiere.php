<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;

    protected $table = 'MATIERE';
    protected $primaryKey = 'CodeMatiere';
    public $incrementing = true; // Clé primaire auto-incrémentée

    protected $fillable = [
        'LibelleMatiere',
    ];

    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'ENSEIGNER', 'CodeMatiere', 'IdClasse')
            ->withPivot('IdEnseignant');
    }

    

    public function enseignants()
    {
        return $this->belongsToMany(Enseignant::class, 'ENSEIGNER', 'CodeMatiere', 'IdEnseignant');
    }


}
