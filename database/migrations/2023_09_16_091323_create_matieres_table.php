<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatieresTable extends Migration
{
    public function up()
    {
        Schema::create('MATIERE', function (Blueprint $table) {
            $table->id('CodeMatiere'); // Clé primaire auto-incrémentée
            $table->string('LibelleMatiere', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('MATIERE');
    }
}
