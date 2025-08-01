<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Personnel extends Model
{
    public function salaires(): BelongsTo
    {
        return $this->belongsTo(Salaire::class);
    }
    public function depenses(): HasMany
    {
        return $this->hasMany(Depense::class);
    }
    
}
