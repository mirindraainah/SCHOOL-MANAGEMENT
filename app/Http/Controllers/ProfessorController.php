<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Eleve;
use App\Models\Matiere;
use App\Models\Examen;
use App\Models\Faire;
use App\Models\Classe; // Assurez-vous d'importer la classe Classe

class ProfessorController extends Controller
{
    public function index()
    {
        // enseignant actuellement connecté 
        $enseignant = Auth::user()->enseignant;

        // matières et les classes associées à cet enseignant
        $matieresEnseignees = $enseignant->matieres;
        $classesEnseignees = $enseignant->classes->unique();
        $matieresParClasse = []; 

        foreach ($classesEnseignees as $classe) {
            // matières enseignées par l'enseignant dans cette classe
            $matieres = $enseignant->matieres()->where('IdClasse', $classe->IdClasse)->get();
            $matieresParClasse[$classe->IdClasse] = $matieres;
        }
   
        $totalElevesEnseignes = $classesEnseignees->sum(function ($classe) {
            return $classe->eleves->count();
        });
    
        return view('professor.dashboard', compact('matieresParClasse', 'matieresEnseignees', 'classesEnseignees', 'totalElevesEnseignes'));
    }



    
}
