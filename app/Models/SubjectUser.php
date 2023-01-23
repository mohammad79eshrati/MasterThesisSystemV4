<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SubjectUser extends Pivot
{

    public $incrementing = true;
    protected $table = "user_subject";
}
