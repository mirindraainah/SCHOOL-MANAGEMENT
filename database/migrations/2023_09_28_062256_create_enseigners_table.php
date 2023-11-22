<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ENSEIGNER', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('CodeMatiere');
            $table->unsignedBigInteger('IdClasse');
            $table->string('IdEnseignant', 10);
            $table->timestamps();

            // Clés étrangères
            $table->foreign('CodeMatiere')->references('CodeMatiere')->on('MATIERE')->onDelete('cascade');
            $table->foreign('IdClasse')->references('IdClasse')->on('CLASSE')->onDelete('cascade');
            $table->foreign('IdEnseignant')->references('IdEnseignant')->on('ENSEIGNANT')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ENSEIGNER');
    }
};
