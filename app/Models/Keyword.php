<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Keyword extends Model
{

    protected $table = "keywords";

    public function defenses(): BelongsToMany
    {
        return $this->belongsToMany(Defense::class);
    }
}
