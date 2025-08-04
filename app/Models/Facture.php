<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Facture extends Model
{
    public function depense()
    {
        return $this->belongsTo(Depense::class);
    }
}
