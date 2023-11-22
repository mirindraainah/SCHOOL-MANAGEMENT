<div>
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold text-indigo-600 mb-6">
            <i class="fas fa-clipboard-list mr-2"></i>Notes
        </h2>
        
        <form method="POST" action="{{ route('professor.afficher-notes') }}">
            @csrf
            {{-- {{dd($params)}} --}}
            <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
                <div class="">
                    <label for="classe" class="block text-gray-600">
                        Classe
                    </label>
                    <select name="classe" id="classe" class="block w-full px-4 py-2 border rounded-md text-gray-700 focus:ring focus:ring-indigo-300 focus:border-indigo-300" required>
                        <option value="">Sélectionner une classe</option>
                        @foreach ($classes as $classe)
                            <option value="{{ $classe->IdClasse }}" {{ $params['classeId'] == $classe->IdClasse ? 'selected' : '' }}>
                                {{ $classe->NomClasse }}
                            </option>
                        @endforeach
                    </select>
                </div>
    
                <div class="">
                    <label for="matiere" class="block text-gray-600">
                        Matière
                    </label>
                    <select name="matiere" id="matiere" class="block w-full px-4 py-2 border rounded-md text-gray-700 focus:ring focus:ring-indigo-300 focus:border-indigo-300" required>
                        <option value="">Sélectionner une matière</option>
                        @foreach ($matieres as $matiere)
                            <option value="{{ $matiere->CodeMatiere }}" {{ $params['matiereCode'] == $matiere->CodeMatiere ? 'selected' : '' }}>
                                {{ $matiere->LibelleMatiere }}
                            </option>
                        @endforeach
                    </select>
                </div>
    
                <div class="">
                    <label for="examen" class="block text-gray-600">
                        Examen
                    </label>
                    <select name="examen" id="examen" class="block w-full px-4 py-2 border rounded-md text-gray-700 focus:ring focus:ring-indigo-300 focus:border-indigo-300" required>
                        <option value="">Sélectionner un examen</option>
                        @foreach ($examens as $examen)
                            <option value="{{ $examen->IdExamen }}" {{ $params['examenId'] == $examen->IdExamen ? 'selected' : '' }}>
                                {{ $examen->LibelleExamen }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
    
            <button type="submit" class="mt-5 px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
                <i class="fas fa-filter mr-2"></i> Filtrer
            </button>
        </form>
    
        <div class="relative mt-1">
            <input wire:model.live="search" type="text" id="recherche" name="recherche" placeholder="Rechercher" class="border rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring focus:border-to-purple-300">
            <div class="absolute left-3 top-2">
                <i class="fa fa-search text-gray-400"></i>
            </div>
        </div>
        <!-- Tableau pour afficher les notes filtrées -->
        <div class="overflow-x-auto mt-6">
            <!-- Tableau pour afficher les notes filtrées -->
            <table class="table-auto w-full mt-6">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="px-4 py-2 text-left">Élève</th>
                        <th class="px-4 py-2 text-left">Note</th>
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notes as $note)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-4 py-2">{{ $note->eleve->NomEleve }} {{ $note->eleve->PrenomEleve }}</td>
                            <td class="px-4 py-2">{{ $note->Note }}</td>
                            <td class="px-4 py-2">{{ $note->Date }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('professor.edit', ['Matricule' => $note->Matricule, 'IdExamen' => $note->IdExamen, 'CodeMatiere' => $note->CodeMatiere]) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form class="inline-block" method="POST" action="{{ route('professor.destroy', ['Matricule' => $note->Matricule, 'IdExamen' => $note->IdExamen, 'CodeMatiere' => $note->CodeMatiere]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer delete-button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    
        </div>
    </div>
    
    <script>
        var params = @json($params);
        var id = params.classeId;
        initMatiere(id);
        function initMatiere(id) {
            var matieresParClasse = @json($matieresParClasse);
            var matiereSelect = document.getElementById('matiere');
            matiereSelect.innerHTML = '<option value="">Toutes les matières</option>';
    
            if (id) {
                var selectedClassMatieres = matieresParClasse[id];
                if (selectedClassMatieres) {
                    selectedClassMatieres.forEach(function(matiere) {
                        let selected = matiere.CodeMatiere == params.matiereCode ? 'selected': 'dddd';
                        matiereSelect.innerHTML += '<option value="' + matiere.CodeMatiere + '" '+ selected +' >' + matiere.LibelleMatiere + '</option>';
                    });
                }
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            var classeSelect = document.getElementById('classe');
            var matiereSelect = document.getElementById('matiere');
            classeSelect.addEventListener('change', function() {
                var selectedClass = classeSelect.value;
                var matieresParClasse = @json($matieresParClasse);
    
                matiereSelect.innerHTML = '<option value="">Toutes les matières</option>';
    
                if (selectedClass) {
                    var selectedClassMatieres = matieresParClasse[selectedClass];
    
                    if (selectedClassMatieres) {
                        selectedClassMatieres.forEach(function(matiere) {
                            matiereSelect.innerHTML += '<option value="' + matiere.CodeMatiere + '">' + matiere.LibelleMatiere + '</option>';
                        });
                    }
                }
            });
    
            var deleteButtons = document.querySelectorAll('.delete-button');
    
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
    
                    Swal.fire({
                        title: 'Êtes-vous sûr?',
                        text: 'Une fois supprimé, vous ne pourrez pas revenir en arrière!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: 'gray',
                        confirmButtonText: 'OK',
                        cancelButtonText: 'Annuler'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Si l'utilisateur a cliqué sur OK, soumettez le formulaire de suppression
                            e.target.closest('form').submit();
                        }
                    });
                });
            });
        });
    
    
        
    </script>
</div>
