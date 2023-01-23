<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Professor extends Model
{

    protected $primaryKey = "prof_id";
    protected $table = "professors";
    public $incrementing = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function defenses(): HasMany
    {
        return $this->hasMany(Defense::class, "prof_id", "prof_id");
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, "department_id", "id");
    }
}
