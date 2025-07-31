<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Personnel extends Model
{
    public function salaires(): BelongsTo
    {
        return $this->belongsTo(Salaire::class);
    }
}
