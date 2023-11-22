@extends('accueil')

@section('content')

<div class="mb-5 flex flex-col md:flex-row justify-between items-center md:items-start">
    <div class="flex items-center">
        <h2 class="text-3xl font-extrabold text-gray-200 mt-2 md:mt-0 ml-2 transform hover:scale-105 transition-transform duration-300 ease-in-out">Détails de l'Enseignant</h2>
    </div>
    <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
        <a href="{{ route('enseignant.index') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
            <i class="fas fa-arrow-left mr-2"></i> Retour à la Liste des Enseignants
        </a>
    </div>
</div>

<div class="bg-white shadow-md rounded-lg p-6">
    <div class="grid gap-4">
        <div class="form-group flex items-center">
            <label for="IdEnseignant" class="block text-sm font-medium text-gray-700 mr-2">ID de l'Enseignant:</label>
            <span>{{ $enseignant->IdEnseignant }}</span>
        </div>

        <div class="form-group flex items-center">
            <label for="NomEnseignant" class="block text-sm font-medium text-gray-700 mr-2">Nom:</label>
            <span>{{ $enseignant->NomEnseignant }}</span>
        </div>

        <div class="form-group flex items-center">
            <label for="PrenomEnseignant" class="block text-sm font-medium text-gray-700 mr-2">Prénom:</label>
            <span>{{ $enseignant->PrenomEnseignant }}</span>
        </div>

        <div class="form-group flex items-center">
            <label for="AdresseEnseignant" class="block text-sm font-medium text-gray-700 mr-2">Adresse:</label>
            <span>{{ $enseignant->AdresseEnseignant }}</span>
        </div>

        <div class="form-group flex items-center">
            <label for="Contact" class="block text-sm font-medium text-gray-700 mr-2">Contact:</label>
            <span>{{ $enseignant->Contact }}</span>
        </div>

        <div class="form-group flex items-center">
            <label for="IdUtilisateur" class="block text-sm font-medium text-gray-700 mr-2">ID Utilisateur:</label>
            <span>{{ $enseignant->IdUtilisateur }}</span>
        </div>
    </div>
</div>

@endsection
