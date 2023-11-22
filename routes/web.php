<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\AvoirController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\FaireController;

// Accueil
Route::get('/', function () {
    return view('auth.login');
});

// Routes authentifiées
Route::middleware(['auth'])->group(function () {
    
    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Dashboard
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // Routes pour l'administration (utilisateur, classe, enseignant, matiere, avoir, eleve, examen)
        Route::resource('user', UserController::class)->middleware('admin');
        Route::resource('classe', ClasseController::class)->middleware('admin');
        Route::resource('enseignant', EnseignantController::class)->middleware('admin');
        Route::resource('matiere', MatiereController::class)->middleware('admin');
        Route::resource('avoir', AvoirController::class)->middleware('admin');
        Route::resource('eleve', EleveController::class)->middleware('admin');
        Route::resource('examen', ExamenController::class)->middleware('admin');
        Route::get('afficher-note', [FaireController::class, 'afficherNotesAdmin'])->name('admin.afficher-note-admin');
    });

    // Professeur Dashboard
    Route::middleware(['professor'])->group(function () {
        Route::get('/professor-dashboard', [ProfessorController::class, 'index'])->name('professor.dashboard');

        // Routes liées aux notes
        Route::get('/professor/students-by-class', [FaireController::class, 'studentsByClass'])->name('professor.students-by-class');
        Route::get('/professor/ajouter-note', [FaireController::class, 'ajouterNote'])->name('professor.ajouter-note');
        Route::post('/professor/enregistrer-note', [FaireController::class, 'enregistrerNote'])->name('professor.enregistrer-note');
        Route::get('/professor/afficher-note', [FaireController::class, 'afficherNotes'])->name('professor.afficher-note');
        Route::match(['get', 'post'], '/professor/afficher-notes', [FaireController::class, 'afficherNotes2'])->name('professor.afficher-notes');
        Route::get('/professor/edit/{Matricule}/{IdExamen}/{CodeMatiere}', [FaireController::class, 'edit'])->name('professor.edit');
        Route::put('/professor/update/{Matricule}/{IdExamen}/{CodeMatiere}', [FaireController::class, 'update'])->name('professor.update');
        Route::delete('/professor/destroy/{Matricule}/{IdExamen}/{CodeMatiere}', [FaireController::class, 'destroy'])->name('professor.destroy');


    });


});

// Auth routes
require __DIR__.'/auth.php';
