<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["name", "email", "password"];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["password", "remember_token"];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    protected $table = "users";

    public function name(): string
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class)->using(SubjectUser::class);
    }

    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class);
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    public function professor(): HasOne
    {
        return $this->hasOne(Professor::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(UserSession::class);
    }

    public function isNotBanned()
    {
        if ($this->role === "admin") {
            return !$this->admin->is_blocked;
        } elseif ($this->role === "professor") {
            return !$this->professor->is_blocked;
        } elseif ($this->role === "student") {
            return !$this->student->is_blocked;
        }
        return false;
    }

    public function getUserId()
    {
        if ($this->role === "admin") {
            return $this->admin->id;
        } elseif ($this->role === "professor") {
            return $this->professor->prof_id;
        } elseif ($this->role === "student") {
            return $this->student->std_num;
        }
        return -1;
    }


    public function isOnline(): bool
    {
        $session = collect($this->sessions)->sortByDesc('last_activity')->first();
        if ($session !== null)
            return Carbon::createFromTimestamp($session->last_activity)->gt(Carbon::now()->subMinutes(5));
        return false;
    }
}
