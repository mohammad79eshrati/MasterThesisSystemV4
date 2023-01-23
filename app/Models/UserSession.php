<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    protected $table = "sessions";


    public function user()
    {
        return $this->hasOne(User::class);
    }
}
