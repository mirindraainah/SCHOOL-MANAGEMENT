@extends('accueil_prof')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold text-indigo-600 mb-6">
            <i class="fas fa-clipboard-list mr-2"></i> Ajout notes
        </h2>
        <a href="javascript:history.back()" class="text-indigo-600 hover:underline hover:text-indigo-800">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>
    <form method="POST" action="{{ route('professor.enregistrer-note') }}">
        @csrf
        <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
            <div class="">
                <label for="classe" class="block text-gray-600">
                    Classe
                </label>
                <select id="classe" name="classe" class="block w-full px-4 py-2 border rounded-md text-gray-700 focus:ring focus:ring-indigo-300 focus:border-indigo-300" required>
                    <option value="">Sélectionnez une classe</option>
                    @foreach ($classesEnseignees as $classe)
                        <option value="{{ $classe->IdClasse }}">{{ $classe->NomClasse }}</option>
                    @endforeach
                </select>
            </div>

            <div class="">
                <label for="matiere" class="block text-gray-600">
                    Matière
                </label>
                <select id="matiere" name="matiere" class="block w-full px-4 py-2 border rounded-md text-gray-700 focus:ring focus:ring-indigo-300 focus:border-indigo-300" required>
                    <option value="">Sélectionnez une matière</option>
                </select>
            </div>

            <div class="">
                <label for="examen" class="block text-gray-600">
                    Examen
                </label>
                <select id="examen" name="examen" class="block w-full px-4 py-2 border rounded-md text-gray-700 focus:ring focus:ring-indigo-300 focus:border-indigo-300" required>
                    <option value="">Sélectionnez un examen</option>
                    @foreach ($examens as $examen)
                        <option value="{{ $examen->IdExamen }}">{{ $examen->LibelleExamen }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-5">
            <label for="date_examen" class="block text-gray-600">
                Date de l'Examen
            </label>
            <input type="date" id="date_examen" name="date_examen" class="block w-full px-4 py-2 border rounded-md text-gray-700 focus:ring focus:ring-indigo-300 focus:border-indigo-300" required>
        </div>
        
        <div class="mt-5">
            <label for="coefficient" class="block text-gray-600">
                Coefficient
            </label>
            <input type="number" id="coefficient" name="coefficient" class="block w-full px-4 py-2 border rounded-md text-gray-700 focus:ring focus:ring-indigo-300 focus:border-indigo-300" required>
        </div>
        
        @error('note')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <table id="notesTable" class="table-auto w-full mt-4">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-indigo-600">
                        <i class="fas fa-user-graduate mr-2"></i> Élève
                    </th>
                    <th class="px-4 py-2 text-left text-indigo-600">
                        <i class="fas fa-star mr-2"></i> Note
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- Ajoutées dynamiquement par JavaScript -->
            </tbody>
        </table>


        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
            <i class="fas fa-save mr-2"></i> Enregistrer
        </button>
    </form>

    <!-- Afficher l'alerte uniquement s'il y a des notes enregistrées avec succès -->
    @if(session('success'))
    <div class="bg-indigo-100 text-indigo-600 border-l-4 border-indigo-500 p-4 mt-6" role="alert">
        Notes bien enregistrées
    </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var classeSelect = document.getElementById('classe');
        var matiereSelect = document.getElementById('matiere');
        var notesTable = document.getElementById('notesTable');
        var elevesTableBody = document.querySelector('#notesTable tbody');

        // Gérez les changements de classe
        classeSelect.addEventListener('change', function() {
            var selectedClass = classeSelect.value;
            var selectedMatiere = matiereSelect.value;

            // Réinitialisez le select de matière
            matiereSelect.innerHTML = '<option value="">Sélectionnez une matière</option>';

            // Réinitialisez le tableau des élèves
            elevesTableBody.innerHTML = '';

            if (selectedClass) {
                // Remplissez le select des matières en fonction de la classe sélectionnée
                var matieres = @json($matieresParClasse);
                var selectedClassMatieres = matieres[selectedClass];

                if (selectedClassMatieres) {
                    selectedClassMatieres.forEach(function(matiere) {
                        matiereSelect.innerHTML += '<option value="' + matiere.CodeMatiere + '">' + matiere.LibelleMatiere + '</option>';
                    });
                }
            }
        });

        // Gérez les changements de matière
        matiereSelect.addEventListener('change', function() {
            var selectedClass = classeSelect.value;
            var selectedMatiere = matiereSelect.value;

            // Réinitialisez le tableau des élèves
            elevesTableBody.innerHTML = '';

            if (selectedMatiere) {
                // Remplissez le tableau des élèves en fonction de la classe et de la matière sélectionnées
                var eleves = @json($eleves);
                var selectedClassEleves = eleves.filter(function(eleve) {
                    return eleve.IdClasse == selectedClass;
                });

                if (selectedClassEleves) {
                    selectedClassEleves.forEach(function(eleve) {
                        elevesTableBody.innerHTML += '<tr><td class="px-4 py-2">' + eleve.NomEleve + ' ' + eleve.PrenomEleve + '</td><td class="px-4 py-2"><input type="text" name="note[]" class="w-full px-4 py-2 border rounded-md text-gray-700 focus:ring focus:ring-indigo-300 focus:border-indigo-300" required></td><input type="hidden" name="matricule[]" value="' + eleve.Matricule + '"></tr>';
                    });
                }
            }
        });
    });
</script>
@endsection
