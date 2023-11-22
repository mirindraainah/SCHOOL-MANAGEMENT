@extends('accueil_prof')

@section('content')

<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-semibold text-indigo-600 mb-6">
        <i class="fas fa-clipboard-list mr-2"></i> Notes des Élèves
    </h2>
    <form method="GET" action="{{ route('professor.afficher-note') }}">
        @csrf
        <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
            <div class="">
                <label for="classe" class="block text-gray-600">
                    Classe
                </label>
                <select id="classe" name="classe" class="block w-full px-4 py-2 border rounded-md text-gray-700 focus:ring focus:ring-indigo-300 focus:border-indigo-300" required>
                    <option value="">Sélectionnez une classe</option>
                    @foreach ($classes as $classe)
                        <option value="{{ $classe->IdClasse }}" {{ request('classe') == $classe->IdClasse ? 'selected' : '' }}>
                            {{ $classe->NomClasse }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="" id="matiere-group" style="{{ request('classe') ? 'display:block;' : 'display:none;' }}">
                <label for="matiere" class="block text-gray-600">
                    Matière
                </label>
                <select id="matiere" name="matiere" class="block w-full px-4 py-2 border rounded-md text-gray-700 focus:ring focus:ring-indigo-300 focus:border-indigo-300" required>
                    <option value="">Sélectionnez une matière</option>
                    @foreach ($matieresParClasse[request('classe', '')] ?? [] as $codeMatiere => $libelleMatiere)
                        <option value="{{ $codeMatiere }}" {{ request('matiere') == $codeMatiere ? 'selected' : '' }}>
                            {{ $libelleMatiere }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="" id="examen-group" style="{{ request('matiere') ? 'display:block;' : 'display:none;' }}">
                <label for="examen" class="block text-gray-600">
                    Examen
                </label>
                <select id="examen" name="examen" class="block w-full px-4 py-2 border rounded-md text-gray-700 focus:ring focus:ring-indigo-300 focus:border-indigo-300" required>
                    <option value="">Sélectionnez un examen</option>
                    @foreach ($examens as $examen)
                        <option value="{{ $examen->IdExamen }}" {{ request('examen') == $examen->IdExamen ? 'selected' : '' }}>
                            {{ $examen->LibelleExamen }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="mt-5 px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
            <i class="fas fa-search mr-2"></i> Afficher les notes
        </button>
    </form>

    <h1 class="mt-5">Date de l'examen : {{ $dateExamen }}</h1>
    <h1> Coefficient : {{ $coefficient }}</h1>

    <!-- Affiche les notes en fonction des critères -->
    @if(count($notes) > 0)
    <table class="table-auto w-full mt-6">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-indigo-600">
                    <i class="fas fa-user-graduate mr-2"></i> Élève
                </th>
                <th class="px-4 py-2 text-left text-indigo-600">
                    <i class="fas fa-star mr-2"></i> Note
                </th>
                <th class="px-4 py-2 text-left text-indigo-600">
                    <i class="fas fa-calendar-alt mr-2"></i> Date d'Ajout
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notes as $note)
            <tr class="hover:bg-indigo-100">
                <td class="px-4 py-2">{{ $note->eleve->NomEleve }} {{ $note->eleve->PrenomEleve }}</td>
                <td class="px-4 py-2">{{ $note->Note }}</td>
                <td class="px-4 py-2">{{ $note->Date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="bg-indigo-100 text-indigo-600 border-l-4 border-indigo-500 p-4 mt-6" role="alert">
        Aucune note trouvée pour les critères sélectionnés.
    </div>
    @endif
</div>

<div id="matieresParClasse" data-matieres="{{ json_encode($matieresParClasse) }}"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const classeSelect = document.getElementById('classe');
        const matiereGroup = document.getElementById('matiere-group');
        const matiereSelect = document.getElementById('matiere');
        const examenGroup = document.getElementById('examen-group');
        const examenSelect = document.getElementById('examen');
        const matieresParClasse = JSON.parse(document.getElementById('matieresParClasse').getAttribute('data-matieres'));

        classeSelect.addEventListener('change', function () {
            const selectedClasseId = classeSelect.value;
            const matieres = matieresParClasse[selectedClasseId] || {};

            // Mettez à jour les options de matière
            while (matiereSelect.options.length > 0) {
                matiereSelect.remove(0);
            }

            if (Object.keys(matieres).length === 0) {
                matiereGroup.style.display = 'none';
            } else {
                matiereGroup.style.display = 'block';

                for (const codeMatiere in matieres) {
                    if (matieres.hasOwnProperty(codeMatiere)) {
                        const option = document.createElement('option');
                        option.value = codeMatiere;
                        option.text = matieres[codeMatiere];
                        matiereSelect.appendChild(option);
                    }
                }
            }
            
            // Afficher le champ de sélection de l'examen dès le départ
            examenGroup.style.display = 'block';
        });
    });
</script>

@endsection
