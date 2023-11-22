@extends('accueil')

@section('content')

<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Détails de la Classe</h1>
        <a href="{{ route('classe.index') }}" class="text-indigo-600 hover:underline hover:text-indigo-800">
            <i class="fas fa-arrow-left"></i> Retour à la liste des classes
        </a>
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-semibold">Classe :</h2>
        <p class="text-lg text-gray-800">{{ $classe->NomClasse }}</p>
    </div>

    <div>
        <h2 class="text-xl font-semibold">Matières et Enseignants :</h2>
        @foreach($classe->matieres as $matiere)
        <div class="mb-4">
            <p class="text-lg font-semibold text-gray-800">{{ $matiere->LibelleMatiere }}</p>
            <ul class="list-inside list-disc ml-4 text-gray-600">
                @foreach ($classe->enseignants as $enseignant)
                @if ($enseignant->pivot->CodeMatiere == $matiere->CodeMatiere)
                <li>
                    Enseignant : {{ $enseignant->NomEnseignant }} {{ $enseignant->PrenomEnseignant }}
                </li>
                @endif
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>
</div>

@endsection
