@extends('accueil')

@section('content')
<div class="mb-5 flex flex-col md:flex-row justify-between items-center md:items-start">
    <div class="flex items-center">
        <h2 class="text-3xl font-extrabold text-gray-200 mt-2 md:mt-0 ml-2 transform hover:scale-105 transition-transform duration-300 ease-in-out">Modifier un Élève</h2>
    </div>
    <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
        <a href="{{ route('eleve.index') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
            <i class="fas fa-arrow-left mr-2"></i> Retour à la liste des Élèves
        </a>
    </div>
</div>

<div class="bg-white shadow-md rounded-lg p-6">
    <form action="{{ route('eleve.update', $eleve->Matricule) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf
        @method('PUT')

        <div class="col-span-1">
            <div class="mb-4">
                <label for="Matricule" class="block text-sm font-medium text-gray-700">Matricule</label>
                <input type="text" name="Matricule" placeholder="Matricule de l'élève" class="mt-1 p-2 border rounded-md w-full" value="{{ $eleve->Matricule }}" disabled>
            </div>

            <div class="mb-4">
                <label for="NomEleve" class="block text-sm font-medium text-gray-700">Nom de l'Élève</label>
                <input type="text" name="NomEleve" placeholder="Nom de l'élève" required class="mt-1 p-2 border rounded-md w-full" value="{{ $eleve->NomEleve }}">
            </div>

            <div class="mb-4">
                <label for="PrenomEleve" class="block text-sm font-medium text-gray-700">Prénom de l'Élève</label>
                <input type="text" name="PrenomEleve" placeholder="Prénom de l'élève" required class="mt-1 p-2 border rounded-md w-full" value="{{ $eleve->PrenomEleve }}">
            </div>

            <div class="mb-4">
                <label for="DateNaissance" class="block text-sm font-medium text-gray-700">Date de Naissance</label>
                <input type="date" name="DateNaissance" placeholder="Date de Naissance" required class="mt-1 p-2 border rounded-md w-full" value="{{ $eleve->DateNaissance }}">
            </div>
        </div>

        <div class="col-span-1">
            <div class="mb-4">
                <label for="Sexe" class="block text-sm font-medium text-gray-700">Sexe</label>
                <div class="flex items-center mt-2">
                    <input class="form-check-input" type="radio" name="Sexe" id="sexe_m" value="M" required {{ $eleve->Sexe === 'M' ? 'checked' : '' }}>
                    <label class="ml-2 text-sm text-gray-600" for="sexe_m">Masculin</label>
                    <input class="form-check-input ml-4" type="radio" name="Sexe" id="sexe_f" value="F" required {{ $eleve->Sexe === 'F' ? 'checked' : '' }}>
                    <label class="ml-2 text-sm text-gray-600" for="sexe_f">Féminin</label>
                </div>
            </div>

            <div class="mb-4">
                <label for="AdresseEleve" class="block text-sm font-medium text-gray-700">Adresse de l'Élève</label>
                <input type="text" name="AdresseEleve" placeholder="Adresse de l'élève" required class="mt-1 p-2 border rounded-md w-full" value="{{ $eleve->AdresseEleve }}">
            </div>

            <div class="mb-4">
                <label for="IdClasse" class="block text-sm font-medium text-gray-700">Classe</label>
                <select name="IdClasse" class="mt-1 p-2 border rounded-md w-full" required>
                    @foreach($classes as $classe)
                        <option value="{{ $classe->IdClasse }}" {{ $classe->IdClasse == $eleve->IdClasse ? 'selected' : '' }}>{{ $classe->NomClasse }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-1">
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Ancienne Photo</label>
                    <img src="/imageEleve/{{ $eleve->image }}" width="80" height="80" alt="">
                </div>
            </div>
            <div class="col-span-1">
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Nouvelle Photo</label>
                <div class="flex items-center mt-2">
                    <label for="image" class="cursor-pointer px-4 py-2 bg-gray-200 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring focus:border-indigo-300 active:bg-gray-400 active:text-gray-800 transition duration-150 ease-in-out">
                        Télécharger une image
                        <input type="file" name="image" class="hidden" accept="image/*" id="image">
                    </label>
                    <span id="file-name" class="ml-2 text-gray-600"></span>
                </div>
            </div>
        </div>
        </div>



        <div class="col-span-2 mt-6">
            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
                <i class="fas fa-save mr-2"></i> Mettre à jour
            </button>
            <a href="{{ route('eleve.index') }}" class="ml-2 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                <i class="fas fa-ban mr-2"></i> Annuler
            </a>
        </div>
    </form>
</div>

<script>
    const input = document.querySelector('input[type="file"]');
    const fileName = document.getElementById('file-name');

    input.addEventListener('change', () => {
        fileName.textContent = input.files[0] ? input.files[0].name : '';
    });
</script>

@endsection
