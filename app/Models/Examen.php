<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;
    protected $table = 'EXAMEN'; // Nom de la table associée

    protected $primaryKey = 'IdExamen'; // Clé primaire de la table EXAMEN

    protected $fillable = [
        'LibelleExamen',
    ];

    public function faire()
    {
        return $this->hasMany(Faire::class, 'IdExamen');
    }
}
