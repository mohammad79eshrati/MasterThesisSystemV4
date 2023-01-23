<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Defense extends Model
{

    protected $table = "defenses";

    public function professor(): BelongsTo
    {
        return $this->belongsTo(Professor::class, "prof_id", "prof_id");
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, "std_num", "std_num");
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, "subject_id", "id");
    }

    public function keywords(): BelongsToMany
    {
        return $this->belongsToMany(Keyword::class);
    }
}
