@extends('accueil')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 py-6">
    <!-- Section pour le titre "Bienvenue" -->
    <div class="col-span-full bg-gradient-to-b from-indigo-500 via-indigo-400 to-indigo-300 shadow-lg text-white rounded-lg p-6">
        <h2 class="text-3xl font-semibold mb-2">Bienvenue {{ Auth::user()->name }}!</h2>
        <p class="text-sm text-gray-200">Découvrez les informations essentielles ici.</p>
        <p class="text-sm text-gray-200">"L'éducation est l'arme la plus puissante que vous puissiez utiliser pour changer le monde."</p>
    </div>

    <!-- Section pour les élèves -->
    <div class="bg-white shadow rounded-sm flex justify-between items-center py-3.5 px-3.5 hover:shadow-xl">
        <div class="space-y-2">
            <p class="text-xs text-gray-400 uppercase">Élève(s) inscrit(s)</p>
            <div class="flex items-center space-x-2">
                <p class="text-xl bg-green-50 text-green-500 px-1 rounded">{{ $totalEleves }}</p>
            </div>
        </div>
        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>  
    </div>

    <!-- Section pour les enseignants -->
    <div class="bg-white shadow rounded-sm flex justify-between items-center py-3.5 px-3.5 hover:shadow-xl">
        <div class="space-y-2">
            <p class="text-xs text-gray-400 uppercase">Enseignant(s)</p>
            <div class="flex items-center space-x-2">
                <h1 class="text-xl font-semibold"></h1>
                <p class="text-xl bg-red-50 text-red-500 px-1 rounded">{{ $totalEnseignants }}</p>
            </div>
        </div>
        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>                    
    </div>

    <!-- Section pour les matières -->
    <div class="bg-white shadow rounded-sm flex justify-between items-center py-3.5 px-3.5 hover:shadow-xl">
        <div class="space-y-2">
            <p class="text-xs text-gray-400 uppercase">Matière(s)</p>
            <div class="flex items-center space-x-2">
                <h1 class="text-xl font-semibold"></h1>
                <p class="text-xl bg-blue-50 text-blue-500 px-1 rounded">{{ $totalMatieres }}</p>
            </div>
        </div>
        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
    </div>

    <!-- Section pour les classes -->
    <div class="bg-white shadow rounded-sm flex justify-between items-center py-3.5 px-3.5 hover:shadow-xl">
        <div class="space-y-2">
            <p class="text-xs text-gray-400 uppercase">Classe(s)</p>
            <div class="flex items-center space-x-2">
                <h1 class="text-xl font-semibold"></h1>
                <p class="text-xl bg-purple-50 text-purple-500 px-1 rounded">{{ $totalClasses }}</p>
            </div>
        </div>
        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
    </div>

</div>
@endsection
