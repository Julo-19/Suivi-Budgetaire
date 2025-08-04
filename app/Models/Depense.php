<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Depense extends Model
{
    public function categorie(): BelongsTo
        {
            return $this->belongsTo(Categorie::class);
        }

    public function personnel(): BelongsTo
        {
            return $this->belongsTo(Personnel::class);
        }
    
    public function facture()
    {
        return $this->hasOne(Facture::class);
    }
}
