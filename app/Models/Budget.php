<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    
    public function depenses()
    {
        return $this->hasMany(Depense::class, 'categorie_id', 'categorie_id')
                    ->where('mois', $this->mois)
                    ->where('annee', $this->annee);
    }
}
