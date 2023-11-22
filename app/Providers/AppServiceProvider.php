<?php

namespace App\Providers;

use Illuminate\Foundation\Bootstrap\BootProviders;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        // Validator::extend('validate_note', function ($attribute, $value, $parameters, $validator) {
        //     // $value est la note saisie par l'utilisateur.
        //     // $parameters contient les valeurs passées dans la règle, c'est-à-dire le coefficient maximum autorisé.
    
        //     $coefficient = (float) $parameters[0];
    
        //     // Déterminez la note maximale en fonction du coefficient.
        //     $noteMax = $coefficient * 10;
    
        //     return $value <= $noteMax;
        // });
    }
}
