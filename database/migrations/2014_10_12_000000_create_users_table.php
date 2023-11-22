<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('IdUtilisateur', 10)->primary();
            $table->string('name', 50);
            $table->string('email', 50)->unique();
            $table->string('role', 25);
            $table->string('password', 255);
            $table->string('photo', 50)->nullable(); 
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
