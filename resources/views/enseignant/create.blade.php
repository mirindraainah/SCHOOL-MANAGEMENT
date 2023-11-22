@extends('accueil')

@section('content')

<div class="mb-5 flex flex-col md:flex-row justify-between items-center md:items-start">
    <div class="flex items-center">
        <h2 class="text-3xl font-extrabold text-gray-200 mt-2 md:mt-0 ml-2 transform hover:scale-105 transition-transform duration-300 ease-in-out">Ajout Enseignant</h2>
    </div>
    <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
        <a href="{{ route('enseignant.index') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
            <i class="fas fa-list mr-2"></i> Liste des Enseignants
        </a>
    </div>
</div>

<div class="bg-white shadow-md rounded-lg p-6">
    <form method="POST" action="{{ route('enseignant.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf
        <div class="mb-4">
            <label for="IdEnseignant" class="block text-sm font-medium text-gray-700">ID de l'Enseignant</label>
            <input type="text" name="IdEnseignant" placeholder="ID de l'enseignant" required class="mt-1 p-2 border rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="Contact" class="block text-sm font-medium text-gray-700">Contact de l'Enseignant</label>
            <input type="text" name="Contact" placeholder="Contact de l'enseignant" required class="mt-1 p-2 border rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="NomEnseignant" class="block text-sm font-medium text-gray-700">Nom de l'Enseignant</label>
            <input type="text" name="NomEnseignant" placeholder="Nom de l'enseignant" required class="mt-1 p-2 border rounded-md w-full">
        </div>


        <div class="mb-4">
            <label for="AdresseEnseignant" class="block text-sm font-medium text-gray-700">Adresse de l'Enseignant</label>
            <input type="text" name="AdresseEnseignant" placeholder="Adresse de l'enseignant" required class="mt-1 p-2 border rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="PrenomEnseignant" class="block text-sm font-medium text-gray-700">Prénom de l'Enseignant</label>
            <input type="text" name="PrenomEnseignant" placeholder="Prénom de l'enseignant" required class="mt-1 p-2 border rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="IdUtilisateur" class="block text-sm font-medium text-gray-700">ID l'Utilisateur</label>
            <input type="text" name="IdUtilisateur" placeholder="ID utilisateur" required class="mt-1 p-2 border rounded-md w-full">
        </div>

        <div class="col-span-2 mt-6">
            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
                <i class="fas fa-plus-circle mr-2"></i> Ajouter
            </button>
            <a href="{{ route('enseignant.index') }}" class="ml-2 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                <i class="fas fa-ban mr-2"></i> Annuler
            </a>
        </div>
    </form>
</div>

@endsection
