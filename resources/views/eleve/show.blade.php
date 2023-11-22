@extends('accueil')

@section('content')
<div class="mb-5 flex flex-col md:flex-row justify-between items-center md:items-start">
    <div class="flex items-center">
        <h2 class="text-3xl font-extrabold text-gray-200 mt-2 md:mt-0 ml-2 transform hover:scale-105 transition-transform duration-300 ease-in-out">Détails de l'Élève</h2>
    </div>
    <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
        <a href="{{ route('eleve.index') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
            <i class="fas fa-arrow-left mr-2"></i> Retour à la Liste des Élèves
        </a>
    </div>
</div>

<div class="bg-white shadow-md rounded-lg p-6">
    <div class="grid grid-cols-1 gap-4">
        <div class="md:order-1">
            <img src="/imageEleve/{{ $eleve->image }}" class="img-fluid max-h-96 rounded-lg" alt="Image de l'élève">
        </div>
        <div class="md:order-2">
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <div class="form-group flex items-center">
                        <label for="Matricule" class="block text-sm font-medium text-gray-700 mr-2">Matricule:</label>
                        <span>{{ $eleve->Matricule }}</span>
                    </div>
                </div>

                <div class="col-span-2">
                    <div class="form-group flex items-center">
                        <label for="NomEleve" class="block text-sm font-medium text-gray-700 mr-2">Nom:</label>
                        <span>{{ $eleve->NomEleve }}</span>
                    </div>
                </div>

                <div class="col-span-2">
                    <div class="form-group flex items-center">
                        <label for="PrenomEleve" class="block text-sm font-medium text-gray-700 mr-2">Prénom:</label>
                        <span>{{ $eleve->PrenomEleve }}</span>
                    </div>
                </div>

                <div class="col-span-2">
                    <div class="form-group flex items-center">
                        <label for="Sexe" class="block text-sm font-medium text-gray-700 mr-2">Sexe:</label>
                        <span>{{ $eleve->Sexe }}</span>
                    </div>
                </div>

                <div class="col-span-2">
                    <div class="form-group flex items-center">
                        <label for="DateNaissance" class="block text-sm font-medium text-gray-700 mr-2">Date de Naissance:</label>
                        <span>{{ $eleve->DateNaissance }}</span>
                    </div>
                </div>

                <div class="col-span-2">
                    <div class="form-group flex items-center">
                        <label for="AdresseEleve" class="block text-sm font-medium text-gray-700 mr-2">Adresse:</label>
                        <span>{{ $eleve->AdresseEleve }}</span>
                    </div>
                </div>

                <div class="col-span-2">
                    <div class="form-group flex items-center">
                        <label for="IdClasse" class="block text-sm font-medium text-gray-700 mr-2">Classe:</label>
                        <span>{{ $eleve->classe ? $eleve->classe->NomClasse : 'Non attribuée' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
