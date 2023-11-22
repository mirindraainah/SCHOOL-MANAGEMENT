<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Enseignant;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $enseignants = Enseignant::all();

        return view('user.create', compact('enseignants'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'IdUtilisateur' => 'required|unique:users',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:6',
            'photo' => 'image|mimes:jpg,jpeg,png,gif,svg',
        ]);
        
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $destinationPath = 'imageUser/';
            $profilePhoto = date('YmdHis') . "." . $photo->getClientOriginalExtension();
            $photo->move($destinationPath, $profilePhoto);
            $validatedData['photo'] = $profilePhoto;
        }

        $validatedData['password'] = bcrypt($request->password);

        User::create($validatedData);

        Alert::toast('Ajouté avec succès','success');
        return redirect()->route('user.index')->with('success', 'Utilisateur ajouté avec succès.');
    }

    public function edit($IdUtilisateur)
    {
        $user = User::findOrFail($IdUtilisateur);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $IdUtilisateur)
    {
        $user = User::findOrFail($IdUtilisateur);

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->IdUtilisateur . ',IdUtilisateur',
            'role' => 'nullable',
            'password' => 'nullable|min:6',
            'photo' => 'image|mimes:jpg,jpeg,png,gif,svg',
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        } else {
            unset($validatedData['password']);
        }

        // Si une nouvelle photo de profil est téléchargée
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $destinationPath = 'imageUser/';
            $profilePhoto = date('YmdHis') . "." . $photo->getClientOriginalExtension();
            $photo->move($destinationPath, $profilePhoto);

            // Mise à jour du champ photo avec le nouveau nom du fichier
            $validatedData['photo'] = $profilePhoto;
        }

        $user->update($validatedData);

        Alert::toast('Modifié avec succès','info');
        return redirect()->route('user.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy($IdUtilisateur)
    {
        $user = User::findOrFail($IdUtilisateur);
        $user->delete();

        Alert::toast('Supprimé avec succès','info');
        return redirect()->route('user.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function show($IdUtilisateur)
    {
        $user = User::findOrFail($IdUtilisateur);
        return view('user.show', compact('user'));
    }
}
