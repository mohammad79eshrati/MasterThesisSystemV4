<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DefenseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Models\Field;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/login", function () {
    return view("login");
})->name("login");

Route::post("/login", [LoginController::class, "authenticate"])->name("login");
Route::post("/register", [RegisterController::class, "register"])->name(
    "register"
);

Route::get("/logout", [LogoutController::class, "logout"])->name("logout");

Route::get("/register", function () {
    return view("register", ["fields" => Field::all()]);
})->name("register");

Route::middleware(["auth"])->group(function () {
    Route::get("/home", [HomeController::class, "index"])->name("home");
    Route::get("/", [HomeController::class, "index"])->name("index");

    Route::get("/profile", function () {
        return view("profile");
    })->name("profile");

    Route::prefix("defenses")->group(function () {
        Route::get("/mine", [DefenseController::class, "mine"])->name(
            "defenses.mine"
        );
        Route::get("/create", [DefenseController::class, "create"])->name(
            "defenses.create"
        );
        Route::get("/show/{defense}", [DefenseController::class, "show"])->name(
            "defenses.show"
        );
        Route::get("/subject/{subject}", [
            DefenseController::class,
            "subject_index",
        ])->name("defenses.subject_index");
        Route::get("/keyword/{keyword}", [
            DefenseController::class,
            "keyword_index",
        ])->name("defenses.keyword_index");
        Route::get("/field/{field}/subjects", [
            DefenseController::class,
            "field_subjects",
        ])->name("defenses.field_subjects");
        Route::get("/professor/{professor}", [
            DefenseController::class,
            "professor_index",
        ])->name("defenses.professor_index");
        Route::get("/department/{department}", [
            DefenseController::class,
            "department_index",
        ])->name("defenses.department_index");
        Route::get("/fields", [DefenseController::class, "fields_index"])->name(
            "defenses.fields_index"
        );
        Route::post("/", [DefenseController::class, "store"])->name(
            "defenses.store"
        );
        Route::put("/update/{defense}", [
            DefenseController::class,
            "update",
        ])->name("defenses.update");
        Route::get("/update/{defense}", [
            DefenseController::class,
            "edit",
        ])->name("defenses.edit");
        Route::get("/delete/{defense}", [
            DefenseController::class,
            "destroy",
        ])->name("defenses.delete");
        Route::post("/delete", [
            DefenseController::class,
            "multi_delete",
        ])->name("defenses.multi_delete");
    });

    Route::prefix("interests")->group(function () {
        Route::get("/", [InterestController::class, "index"])->name(
            "interests"
        );
        Route::get("/add/{subject}", [InterestController::class, "add"])->name(
            "interests.add"
        );
        Route::get("/remove/{subject}", [
            InterestController::class,
            "remove",
        ])->name("interests.remove");
    });

    Route::put("/update_profile/{user}", [
        UserController::class,
        "update",
    ])->name("update_profile");
    Route::middleware('is_admin')->prefix("management")->group(function () {
        Route::get("/", [HomeController::class, "index_management"])->name("management.home");
        Route::prefix("defenses")->group(function () {
            Route::get("/", [DefenseController::class, "index"])->name(
                "defenses"
            );

        });

        Route::middleware('is_owner')->prefix("admins")->group(function () {
            Route::get("/create", [AdminController::class, "create"])->name(
                "admins.create"
            );
            Route::get("/", [AdminController::class, "index"])->name("admins");
            Route::post("/", [AdminController::class, "store"])->name(
                "admins.store"
            );
            Route::put("/update", [AdminController::class, "update"])->name(
                "admins.update"
            );
            Route::get("/update", [AdminController::class, "edit"])->name(
                "admins.edit"
            );
            Route::get("/block/{admin}", [
                AdminController::class,
                "block",
            ])->name("admins.block");
            Route::get("/unblock/{admin}", [
                AdminController::class,
                "unblock",
            ])->name("admins.unblock");
            Route::get("/delete/{admin}", [
                AdminController::class,
                "destroy",
            ])->name("admins.delete");
            Route::post("/delete", [
                AdminController::class,
                "multi_delete",
            ])->name("admins.multi_delete");
            Route::post("/switch_status", [
                AdminController::class,
                "switch_status",
            ])->name("admins.switch_status");
        });

        Route::prefix("professors")->group(function () {
            Route::get("/create", [ProfessorController::class, "create"])->name(
                "professors.create"
            );
            Route::get("/", [ProfessorController::class, "index"])->name(
                "professors"
            );
            Route::post("/", [ProfessorController::class, "store"])->name(
                "professors.store"
            );
            Route::put("/update", [ProfessorController::class, "update"])->name(
                "professors.update"
            );
            Route::get("/update", [ProfessorController::class, "edit"])->name(
                "professors.edit"
            );
            Route::get("/block/{professor}", [
                ProfessorController::class,
                "block",
            ])->name("professors.block");
            Route::get("/unblock/{professor}", [
                ProfessorController::class,
                "unblock",
            ])->name("professors.unblock");
            Route::get("/delete/{professor}", [
                ProfessorController::class,
                "destroy",
            ])->name("professors.delete");
            Route::post("/delete", [
                ProfessorController::class,
                "multi_delete",
            ])->name("professors.multi_delete");
            Route::post("/switch_status", [
                ProfessorController::class,
                "switch_status",
            ])->name("professors.switch_status");
        });

        Route::prefix("students")->group(function () {
            Route::get("/create", [StudentController::class, "create"])->name(
                "students.create"
            );
            Route::get("/", [StudentController::class, "index"])->name(
                "students"
            );
            Route::post("/", [StudentController::class, "store"])->name(
                "students.store"
            );
            Route::put("/update", [StudentController::class, "update"])->name(
                "students.update"
            );
            Route::get("/update", [StudentController::class, "edit"])->name(
                "students.edit"
            );
            Route::get("/block/{student}", [
                StudentController::class,
                "block",
            ])->name("students.block");
            Route::get("/unblock/{student}", [
                StudentController::class,
                "unblock",
            ])->name("students.unblock");
            Route::get("/delete/{student}", [
                StudentController::class,
                "destroy",
            ])->name("students.delete");
            Route::post("/delete", [
                StudentController::class,
                "multi_delete",
            ])->name("students.multi_delete");
            Route::post("/switch_status", [
                StudentController::class,
                "switch_status",
            ])->name("students.switch_status");
        });

        Route::prefix("departments")->group(function () {
            Route::get("/create", [
                DepartmentController::class,
                "create",
            ])->name("departments.create");
            Route::get("/", [DepartmentController::class, "index"])->name(
                "departments"
            );
            Route::post("/", [DepartmentController::class, "store"])->name(
                "departments.store"
            );
            Route::put("/update", [
                DepartmentController::class,
                "update",
            ])->name("departments.update");
            Route::get("/update", [DepartmentController::class, "edit"])->name(
                "departments.edit"
            );
            Route::get("/delete/{department}", [
                DepartmentController::class,
                "destroy",
            ])->name("departments.delete");
            Route::post("/delete", [
                DepartmentController::class,
                "multi_delete",
            ])->name("departments.multi_delete");
        });

        Route::prefix("fields")->group(function () {
            Route::get("/create", [FieldController::class, "create"])->name(
                "fields.create"
            );
            Route::get("/", [FieldController::class, "index"])->name("fields");
            Route::post("/", [FieldController::class, "store"])->name(
                "fields.store"
            );
            Route::put("/update", [FieldController::class, "update"])->name(
                "fields.update"
            );
            Route::get("/update", [FieldController::class, "edit"])->name(
                "fields.edit"
            );
            Route::get("/delete/{field}", [
                FieldController::class,
                "destroy",
            ])->name("fields.delete");
            Route::post("/delete", [
                FieldController::class,
                "multi_delete",
            ])->name("fields.multi_delete");
        });

        Route::prefix("subjects")->group(function () {
            Route::get("/create", [SubjectController::class, "create"])->name(
                "subjects.create"
            );
            Route::get("/", [SubjectController::class, "index"])->name(
                "subjects"
            );
            Route::post("/", [SubjectController::class, "store"])->name(
                "subjects.store"
            );
            Route::put("/update", [SubjectController::class, "update"])->name(
                "subjects.update"
            );
            Route::get("/update", [SubjectController::class, "edit"])->name(
                "subjects.edit"
            );
            Route::get("/delete/{subject}", [
                SubjectController::class,
                "destroy",
            ])->name("subjects.delete");
            Route::post("/delete", [
                SubjectController::class,
                "multi_delete",
            ])->name("subjects.multi_delete");
        });

        Route::prefix("keywords")->group(function () {
            Route::get("/create", [KeywordController::class, "create"])->name(
                "keywords.create"
            );
            Route::get("/", [KeywordController::class, "index"])->name(
                "keywords"
            );
            Route::post("/", [KeywordController::class, "store"])->name(
                "keywords.store"
            );
            Route::put("/update", [KeywordController::class, "update"])->name(
                "keywords.update"
            );
            Route::get("/update", [KeywordController::class, "edit"])->name(
                "keywords.edit"
            );
            Route::get("/delete/{keyword}", [
                KeywordController::class,
                "destroy",
            ])->name("keywords.delete");
            Route::post("/delete", [
                KeywordController::class,
                "multi_delete",
            ])->name("keywords.multi_delete");
        });
    });
});

Route::get('/forgot-password', function () {
    return view('forgot_password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? redirect()->route('login')->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('reset_password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
