<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('FAIRE', function (Blueprint $table) {
            $table->string('Matricule', 10);
            $table->unsignedBigInteger('IdExamen');
            $table->unsignedBigInteger('CodeMatiere');
            $table->float('Note')->nullable();
            $table->date('Date')->default(now());
            $table->date('DateExamen'); // Ajout de la date de l'examen
            $table->float('Coefficient');
            $table->timestamps();

            $table->primary(['Matricule', 'IdExamen', 'CodeMatiere']);
            
            $table->foreign('Matricule')
                ->references('Matricule')
                ->on('ELEVE')
                ->onDelete('cascade'); // Ajout de la cascade pour la suppression

            $table->foreign('IdExamen')
                ->references('IdExamen')
                ->on('EXAMEN')
                ->onDelete('cascade'); // Ajout de la cascade pour la suppression

            $table->foreign('CodeMatiere')
                ->references('CodeMatiere')
                ->on('MATIERE')
                ->onDelete('cascade'); // Ajout de la cascade pour la suppression
        });
    }

    public function down()
    {
        Schema::dropIfExists('FAIRE');
    }
};
