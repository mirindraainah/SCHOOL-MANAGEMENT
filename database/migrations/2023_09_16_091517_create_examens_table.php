<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('EXAMEN', function (Blueprint $table) {
            $table->id('IdExamen');
            $table->string('LibelleExamen', 25);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('EXAMEN');
    }
};
