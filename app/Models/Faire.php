<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faire extends Model
{
    use HasFactory;
    protected $table = 'FAIRE'; // Nom de la table associée

    protected $primaryKey = ['Matricule', 'IdExamen', 'CodeMatiere'];

    public $incrementing = false; // La clé primaire n'est pas auto-incrémentée

    protected $fillable = [
        'Matricule',
        'IdExamen',
        'CodeMatiere',
        'Note',
        'Date',
        'DateExamen',
        'Coefficient',
    ];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'Matricule');
    }

    public function examen()
    {
        return $this->belongsTo(Examen::class, 'IdExamen');
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'CodeMatiere');
    }

}
