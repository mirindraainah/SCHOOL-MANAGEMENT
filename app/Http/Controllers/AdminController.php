<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eleve;
use App\Models\Enseignant;
use App\Models\Matiere;
use App\Models\Classe;

class AdminController extends Controller
{
    public function index()
    {
        $totalEleves = Eleve::count();
        $totalEnseignants = Enseignant::count(); 
        $totalMatieres = Matiere::count(); 
        $totalClasses = Classe::count(); 
        return view('admin.dashboard', compact('totalEleves', 'totalEnseignants', 'totalMatieres', 'totalClasses'));
    }
    
}

