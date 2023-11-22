@extends('accueil_prof')

@section('content')
<div class="mb-5 flex flex-col md:flex-row justify-between items-center md:items-start">
    <div class="flex items-center">
        <h2 class="text-3xl font-extrabold text-gray-200 mt-2 md:mt-0 ml-2 transform hover:scale-105 transition-transform duration-300 ease-in-out">Modifier Note</h2>
    </div>
    <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
        <a href="{{ route('professor.afficher-notes') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
            <i class="fas fa-list mr-2"></i> Liste des notes
        </a>
    </div>
</div>
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="mb-3">
        <label for="eleve" class="form-label">Élève:</label>
        <span>{{ $note->eleve->NomEleve }} {{ $note->eleve->PrenomEleve }}</span>
    </div>
    <div class="mb-3">
        <label for="classe" class="form-label">Classe:</label>
        <span>{{ $note->eleve->classe->NomClasse }}</span>
    </div>
    <div class="mb-3">
        <label for="examen" class="form-label">Examen:</label>
        <span>{{ $note->examen->LibelleExamen }}</span>
    </div>
    <div class="mb-3">
        <label for="matiere" class="form-label">Matière:</label>
        <span>{{ $note->matiere->LibelleMatiere }}</span>
    </div>
    <div class="mb-3">
        <label for="matiere" class="form-label">Date de l'examen:</label>
        <span>{{ $note->DateExamen }}</span>
    </div>
    <div class="mb-3">
        <label for="matiere" class="form-label">Coefficient:</label>
        <span>{{ $note->Coefficient }}</span>
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Date d'Ajout:</label>
        <span>{{ $note->Date }}</span>
    </div>

    <form method="POST"
        action="{{ route('professor.update',['Matricule' => $note->Matricule, 'IdExamen' => $note->IdExamen, 'CodeMatiere' => $note->CodeMatiere]) }}">
        @csrf
        @method('PUT')

        @error('note')
        <div class="text-red-500">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="note" class="form-label">Note:</label>
            <input type="text" name="note" id="note" class="mt-1 p-2 border rounded-md w-full" value="{{ $note->Note }}">
        </div>


        <div class="col-span-2 mt-6">
            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
                <i class="fas fa-check-circle mr-2"></i> Mettre à jour
            </button>
            <a href="javascript:history.back()" class="ml-2 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                <i class="fas fa-ban mr-2"></i> Annuler
            </a>
        </div>
    </form>
</div>

@endsection
