@extends('accueil')
@section('content')

<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-semibold">Modifier Classe</h1>
        <a href="{{ route('classe.index') }}" class="text-gray-600 hover:underline hover:text-gray-800">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>

    <form method="POST" action="{{ route('classe.update', $classe->IdClasse) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="NomClasse" class="block text-sm font-medium text-gray-700">Classe</label>
            <input type="text" name="NomClasse" value="{{ $classe->NomClasse }}" placeholder="" required class="mt-1 p-2 border rounded-md w-full">
        </div>

        <div class="form-group">
            <label for="Matieres">Matieres</label><br>
            @foreach($matieres as $matiere)
            <div class="flex items-center justify-between mb-2">
                <label class="flex items-center">
                    <input type="checkbox" name="matieres[{{ $matiere->CodeMatiere }}]" class="form-checkbox h-5 w-5 text-blue-600" {{ $classe->matieres->contains('CodeMatiere', $matiere->CodeMatiere) ? 'checked' : '' }}>
                    <span class="ml-2">{{ $matiere->LibelleMatiere }}</span>
                </label>
                <select name="enseignants[{{ $matiere->CodeMatiere }}]" class="block mt-1 p-2 border rounded-md w-1/2">
                    <option value="">Sélectionnez l'enseignant</option>
                    @foreach($enseignants as $enseignant)
                    @php
                    $selected = '';
                    // Vérifier si cet enseignant est associé à cette matière pour cette classe
                    $enseignantAssociation = $classe->enseignants->where('pivot.CodeMatiere', $matiere->CodeMatiere)->first();
                    if ($enseignantAssociation && $enseignantAssociation->IdEnseignant === $enseignant->IdEnseignant) {
                        $selected = 'selected';
                    }
                    @endphp
                    <option value="{{ $enseignant->IdEnseignant }}" {{ $selected }}>
                        {{ $enseignant->NomEnseignant }} {{ $enseignant->PrenomEnseignant }}
                    </option>
                    @endforeach
                </select>
            </div>
            @endforeach
        </div>

        <div class="mt-6">
            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
                <i class="fas fa-check-circle mr-2"></i> Modifier
            </button>
            <a href="{{ route('classe.index') }}" class="ml-2 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                <i class="fas fa-ban mr-2"></i> Annuler
            </a>
        </div>
    </form>
</div>
    
@endsection
