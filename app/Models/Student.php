<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends User
{

    protected $primaryKey = "std_num";
    protected $table = "students";
    public $incrementing = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class, "field_id", "id");
    }

    public function defense(): HasOne
    {
        return $this->hasOne(Defense::class, "std_num", "std_num");
    }
}
