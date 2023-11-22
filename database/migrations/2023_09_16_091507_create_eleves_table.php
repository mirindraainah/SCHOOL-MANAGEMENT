<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ELEVE', function (Blueprint $table) {
            $table->string('Matricule', 10)->primary();
            $table->string('NomEleve', 50);
            $table->string('PrenomEleve', 50);
            $table->char('Sexe', 5);
            $table->date('DateNaissance');
            $table->string('AdresseEleve', 50);
            $table->unsignedBigInteger('IdClasse');
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('IdClasse')
                ->references('IdClasse')
                ->on('CLASSE')
                ->onDelete('cascade'); // Ajout de la cascade pour la suppression
        });
    }

    public function down()
    {
        Schema::dropIfExists('ELEVE');
    }
};
