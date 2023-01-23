<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Department extends Model
{

    protected $table = "departments";

    public function subjects(): Collection
    {
        $subjects = collect([]);
        foreach (collect($this->fields) as $f) {
            $subjects = $subjects->concat(collect($f->subjects));
        }
        return $subjects;
    }

    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }
}
