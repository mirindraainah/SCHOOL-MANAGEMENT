@extends('accueil_prof')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
        <!-- Section "Bienvenue" -->
        <div class="bg-gradient-to-b from-indigo-500 via-indigo-400 to-indigo-300 shadow-lg text-white rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-2">Bienvenue, Professeur {{ Auth::user()->name }}!</h3>
            <p class="text-sm text-gray-200">Découvrez les informations essentielles ici.</p>
            <p class="text-sm text-gray-200">"L'éducation est l'arme la plus puissante que vous puissiez utiliser pour changer le monde."</p>
        </div>

        <!-- Section "Classes enseignées" -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-2">Classes enseignées :</h3>
            @if ($classesEnseignees->isNotEmpty())
                <div class="grid grid-cols-1 gap-4">
                    @foreach ($classesEnseignees as $classe)
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold mb-2">{{ $classe->NomClasse }}</h4>
                            <div class="flex flex-wrap">
                                @foreach ($matieresParClasse[$classe->IdClasse] as $matiere)
                                    <span class="bg-indigo-200 text-indigo-800 px-2 py-1 rounded-full text-sm mr-2 mb-2">{{ $matiere->LibelleMatiere }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">Aucune classe enseignée.</p>
            @endif
        </div>


    </div>
</div>
@endsection
