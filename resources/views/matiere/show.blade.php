@extends('accueil')

@section('content')
<div class="mb-5 flex flex-col md:flex-row justify-between items-center md:items-start">
    <div class="flex items-center">
        <h2 class="text-3xl font-extrabold text-gray-200 mt-2 md:mt-0 ml-2 transform hover:scale-105 transition-transform duration-300 ease-in-out">Détails de la Matière</h2>
    </div>
    <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
        <a href="{{ route('matiere.index') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
            <i class="fas fa-list mr-2"></i> Liste des Matières
        </a>
    </div>
</div>

<div class="bg-white shadow-md rounded-lg p-6">
    <div class="mb-4">
        <p class="block text-sm font-medium text-gray-700">Libellé Matière : {{ $matiere->LibelleMatiere }}</p>
        {{-- <p class="block text-sm font-medium text-gray-700">Enseignant : {{ $matiere->enseignants->NomEnseignant }} {{ $matiere->enseignants->PrenomEnseignant }}</p> --}}
    </div>
</div>

@endsection
