<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Defense;
use App\Models\Department;
use App\Models\Field;
use App\Models\Keyword;
use App\Models\Professor;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Policies\AdminPolicy;
use App\Policies\DefensePolicy;
use App\Policies\DepartmentPolicy;
use App\Policies\FieldPolicy;
use App\Policies\KeywordPolicy;
use App\Policies\ProfessorPolicy;
use App\Policies\StudentPolicy;
use App\Policies\SubjectPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Admin::class => AdminPolicy::class,
        Defense::class => DefensePolicy::class,
        Department::class => DepartmentPolicy::class,
        Field::class => FieldPolicy::class,
        Keyword::class => KeywordPolicy::class,
        Professor::class => ProfessorPolicy::class,
        Student::class => StudentPolicy::class,
        Subject::class => SubjectPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
