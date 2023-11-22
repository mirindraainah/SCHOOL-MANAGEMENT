<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('CLASSE', function (Blueprint $table) {
            $table->id('IdClasse');
            $table->string('NomClasse', 25);
        });
    }

    public function down()
    {
        Schema::dropIfExists('CLASSE');
    }
};
