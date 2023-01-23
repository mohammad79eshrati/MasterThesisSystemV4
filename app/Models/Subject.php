<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{

    protected $table = "subjects";
    protected $fillable = ["name", "field_id"];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(SubjectUser::class);
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }

    public function defenses(): HasMany
    {
        return $this->hasMany(Defense::class);
    }
}
