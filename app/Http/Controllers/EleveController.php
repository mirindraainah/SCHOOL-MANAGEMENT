<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Eleve;
use App\Models\Classe;

class EleveController extends Controller
{
    public function index()
    {
        $eleves = Eleve::all();
        return view('eleve.index', compact('eleves'));
    }

    public function create()
    {
        $classes = Classe::all();
        return view('eleve.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Matricule' => 'required|unique:ELEVE',
            'NomEleve' => 'required',
            'PrenomEleve' => 'required',
            'Sexe' => 'required',
            'DateNaissance' => 'required|date',
            'AdresseEleve' => 'required',
            'IdClasse' => 'required|exists:CLASSE,IdClasse',
            'image' => 'image|mimes:jpg,jpeg,png,gif,svg',
        ]);
    
        // Vérifier si un fichier image a été téléchargé
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destinationpath = 'imageEleve/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationpath, $profileImage);
            $validatedData['image'] = $profileImage;
        }
        
        Eleve::create($validatedData);
        
        Alert::toast('Ajouté avec succès','success');
        return redirect()->route('eleve.index');
    }
    

    public function edit($Matricule)
    {
        $eleve = Eleve::findOrFail($Matricule);
        $classes = Classe::all();
        return view('eleve.edit', compact('eleve', 'classes'));
    }

    public function update(Request $request, $Matricule)
    {
        // Valider les données reçues du formulaire
        $validatedData = $request->validate([
            'NomEleve' => 'required',
            'PrenomEleve' => 'required',
            'Sexe' => 'required',
            'DateNaissance' => 'required|date',
            'AdresseEleve' => 'required',
            'IdClasse' => 'required|exists:CLASSE,IdClasse',
            'image' => 'image|mimes:jpg,jpeg,png,gif,svg', // Vous pouvez laisser vide l'image si elle n'est pas modifiée
        ]);
    
        // Récupérer l'élève à mettre à jour
        $eleve = Eleve::findOrFail($Matricule);
    
        // Mettre à jour les champs de l'élève avec les données validées
        $eleve->update([
            'NomEleve' => $validatedData['NomEleve'],
            'PrenomEleve' => $validatedData['PrenomEleve'],
            'Sexe' => $validatedData['Sexe'],
            'DateNaissance' => $validatedData['DateNaissance'],
            'AdresseEleve' => $validatedData['AdresseEleve'],
            'IdClasse' => $validatedData['IdClasse'],
        ]);
    
        // Si une nouvelle image est téléchargée, la gérer
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destinationPath = 'imageEleve/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
    
            // Mettre à jour le champ image avec le nouveau nom du fichier
            $eleve->update(['image' => $profileImage]);
        }

        Alert::toast('Modifié avec succès','info');
        return redirect()->route('eleve.index')->with('success', 'Élève mis à jour avec succès.');
    }
    

    public function destroy($Matricule)
    {
        $eleve = Eleve::findOrFail($Matricule);
       
        $eleve->delete();
        Alert::toast('Supprimé avec succès','info');
        return redirect()->route('eleve.index');
    }

    public function show($Matricule)
    {
        $eleve = Eleve::findOrFail($Matricule);
        return view('eleve.show', compact('eleve'));
    }
}
