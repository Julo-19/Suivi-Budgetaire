<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
