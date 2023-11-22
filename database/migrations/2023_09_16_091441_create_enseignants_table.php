<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ENSEIGNANT', function (Blueprint $table) {
            $table->string('IdEnseignant', 10)->primary(); // Clé primaire
            $table->string('NomEnseignant', 50);
            $table->string('PrenomEnseignant', 50);
            $table->string('AdresseEnseignant', 50);
            $table->string('Contact', 50);
            $table->string('IdUtilisateur')->nullable(); // Clé étrangère vers la table 'users'
            $table->timestamps();

            // Clé étrangère vers la table 'users'
            $table->foreign('IdUtilisateur')
                ->references('IdUtilisateur')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ENSEIGNANT');
    }
};
