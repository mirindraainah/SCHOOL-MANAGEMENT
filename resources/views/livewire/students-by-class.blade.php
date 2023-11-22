<div>
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold text-indigo-600 mb-6">
            <i class="fas fa-clipboard-list mr-2"></i> Liste des élèves par classe
        </h2>
        <div class="mt-4">
            <label for="classeSelect" class="block text-sm font-medium text-gray-700">Sélectionnez une classe :</label>
            <div class="relative mt-1">
                <select wire:model.live="selectedClasse" id="classeSelect" name="classeSelect" class="border rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring focus:border-to-purple-300">
                    @foreach($classesEnseignees as $classe)
                        <option value="{{ $classe }}">{{ $classe }}</option>
                    @endforeach
                </select>
              
            </div>
        </div>
        <div class="mt-4">
            
            <div class="relative mt-1">
                <input wire:model.live.debounce.300ms="search" type="text" id="recherche" name="recherche" placeholder="Rechercher" class="border rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring focus:border-to-purple-300">
                <div class="absolute left-3 top-2">
                    <i class="fa fa-search text-gray-400"></i>
                </div>
            </div>
        </div>

        <table class="min-w-full mt-4 overflow-hidden border divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nom</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Prénom</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Date de Naissance</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Sexe</th>
                </tr>
            </thead>
            <tbody>
                <!-- Affichez la liste des élèves pour la classe sélectionnée -->
                @foreach ($studentsByClass as $student)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $student->NomEleve }}</td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $student->PrenomEleve }}</td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $student->DateNaissance }}</td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $student->Sexe }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
