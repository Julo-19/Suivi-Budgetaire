<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Salaire extends Model
{
    public function personnel(): BelongsTo
    {
        return $this->BelongsTo(Personnel::class);
    }
}
