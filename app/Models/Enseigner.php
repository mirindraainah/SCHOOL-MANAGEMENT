<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseigner extends Model
{
    use HasFactory;

    protected $table = 'ENSEIGNER';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'IdEnseignant',
        'CodeMatiere',
        'IdClasse',
    ];

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class, 'IdEnseignant');
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'CodeMatiere');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'IdClasse');
    }
}
