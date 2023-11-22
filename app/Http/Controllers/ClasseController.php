<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Matiere;
use App\Models\Enseignant;
use App\Models\Enseigner;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Charger les classes avec leurs matières et enseignants associés
        $classes = Classe::with('matieres', 'enseignants')->get();
    
        return view('classe.index', compact('classes'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $matieres = Matiere::all();
        $enseignants = Enseignant::all();
        return view('classe.create', compact('matieres', 'enseignants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'NomClasse' => 'required|max:25',
        ]);
    
        $classe = Classe::create($validatedData);
    
        // Vérifie si des matières ont été cochées
        if ($request->has('matieres') && is_array($request->input('matieres'))) {
            // Parcourir les matières sélectionnées
            foreach ($request->input('matieres') as $codeMatiere => $value) {
                // Vérifier si la matière a été cochée
                if ($value) {
                    $enseignantId = $request->input('enseignants')[$codeMatiere];
    
                    // Enregistrer l'association dans la table "enseigner"
                    Enseigner::create([
                        'CodeMatiere' => $codeMatiere,
                        'IdEnseignant' => $enseignantId,
                        'IdClasse' => $classe->IdClasse,
                    ]);
                }
            }
        }
    
        Alert::toast('Ajouté avec succès','success');
        return redirect()->route('classe.index')->with('success', 'Classe créée avec succès.');
    }
    
    
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($IdClasse)
    {
        $classe = Classe::findOrFail($IdClasse);
        $matieres = Matiere::all();
        $enseignants = Enseignant::all();

        return view('classe.edit', compact('classe', 'matieres', 'enseignants'));
    }
    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $IdClasse)
    {
        $validatedData = $request->validate([
            'NomClasse' => 'required|max:25',
        ]);

        $classe = Classe::findOrFail($IdClasse);
        $classe->update($validatedData);

        // Detach all existing relations
        $classe->matieres()->detach();
        $classe->enseignants()->detach();

        // Attach selected matières and enseignants
        if ($request->has('matieres') && is_array($request->input('matieres'))) {
            foreach ($request->input('matieres') as $codeMatiere => $value) {
                // Vérifier si la matière a été cochée
                if ($value) {
                    $enseignantId = $request->input('enseignants')[$codeMatiere];

                    // Enregistrer l'association dans la table "enseigner"
                    Enseigner::create([
                        'CodeMatiere' => $codeMatiere,
                        'IdEnseignant' => $enseignantId,
                        'IdClasse' => $classe->IdClasse,
                    ]);
                }
            }
        }

        Alert::toast('Modifié avec succès','info');
        return redirect()->route('classe.index')->with('success', 'Classe mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($IdClasse)
    {
        $classe = Classe::findOrFail($IdClasse);

        // Détacher toutes les relations enseigner liées à cette classe
        $classe->enseigner()->detach();

        // Supprimer la classe elle-même
        $classe->delete();

        Alert::toast('Supprimé avec succès','info');
        return redirect()->route('classe.index')->with('success', 'Classe supprimée avec succès.');
    }



    /**
     * Display the specified resource.
     */
    public function show($IdClasse)
    {
        $classe = Classe::findOrFail($IdClasse);
        $matieres = $classe->matieres;
        $enseignants = $classe->enseignants;

        return view('classe.show', compact('classe', 'matieres', 'enseignants'));
    }

}
