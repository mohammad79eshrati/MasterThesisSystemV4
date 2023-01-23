<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Student;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if (Auth::user()->cannot("viewAny", Student::class)) {
            abort(403);
        }
        return view("management.students", [
            "students" => Student::all(),
            "fields" => Field::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot("create", Student::class)) {
            abort(403);
        }

        $data = $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|unique:users|email",
            "password" => ["required", "min:6"],
            "confirm_password" => "required|same:password",
            "birth_date" => "required|date",
            "field_id" => "required",
            "std_num" => "required|unique:students",
        ]);
        $user = new User();
        $user->first_name = $data["first_name"];
        $user->last_name = $data["last_name"];
        $user->email = $data["email"];
        $birth_date = date($data["birth_date"]);
        $user->birth_date = date_create($birth_date);
        $user->password = Hash::make($data["password"]);
        $user->role = "student";
        $user->save();

        $student = new Student();
        $student->std_num = $data["std_num"];
        $student->field_id = $data["field_id"];
        $student->user_id = $user->id;
        $student->save();
        if ($request->ajax()){
            return response()->json(["std_num" => $student->std_num]);
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        if (Auth::user()->cannot("create", Student::class)) {
            abort(403);
        }
        return view("management.students", [
            "students" => Student::all(),
            "fields" => Field::all(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Student $student
     * @return Response
     */
    public function show(Student $student)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param Student $student
     * @return RedirectResponse
     */
    public function block(Student $student)
    {
        if (Auth::user()->cannot("update", $student)) {
            abort(403);
        }
        $student->is_blocked = true;
        $student->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Student $student
     * @return RedirectResponse
     */
    public function unblock(Student $student)
    {
        if (Auth::user()->cannot("update", $student)) {
            abort(403);
        }
        $student->is_blocked = false;
        $student->save();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Student $student
     * @return Application|Factory|View
     */
    public function edit(Student $student)
    {
        if (Auth::user()->cannot("update", $student)) {
            abort(403);
        }
        return view("management.students", [
            "students" => Student::all(),
            "fields" => Field::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request)
    {
        //        dd($request);
        if (
            $request
                ->user()
                ->cannot("update", Student::find($request["std_num"]))
        ) {
            abort(403);
        }
        $data = $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "email" => [
                "email",
                "required",
                function ($attribute, $value, $fail) use ($request) {
                    if (
                        User::where("email", $request->email)
                            ->where("id", "<>", $request->user_id)
                            ->first() !== null
                    ) {
                        $fail("کاربری با این ایمیل وجود دارد");
                    }
                },
            ],
            "birth_date" => "required|date",
            "user_id" => "required",
            "std_num" => [
                "required",
                function ($attribute, $value, $fail) use ($request) {
                    if (
                        Student::where("std_num", $request->std_num)
                            ->where("user_id", "<>", $request->user_id)
                            ->first() !== null
                    ) {
                        $fail("دانشجویی با این شماره دانشجویی وجود دارد");
                    }
                },
            ],
            "field_id" => "required",
        ]);
        if (isset($data["std_num"])) {
            $student = Student::find($data["std_num"]);
            $student->field_id = $data["field_id"];
            $student->save();

            $user = User::find($data["user_id"]);
            $user->first_name = $data["first_name"];
            $user->last_name = $data["last_name"];
            $user->email = $data["email"];
            $user->birth_date = date_create(date($data["birth_date"]));
            $user->save();

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Student $student
     * @return RedirectResponse
     */
    public function destroy(Student $student)
    {
        if (Auth::user()->cannot("forceDelete", $student)) {
            abort(403);
        }
        $student->user->delete();
        $student->delete();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function multi_delete(
        Request $request
    )
    {
        if (Auth::user()->cannot("forceDelete", Student::class)) {
            abort(403);
        }
        User::whereIn("id", $request)->delete();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function switch_status(
        Request $request
    )
    {
        $i = 1;
        while ($request->has((string)$i)) {
            $student = Student::where("user_id", $request[$i])->first();
            if ($request->user()->cannot("update", $student)) {
                abort(403);
            }
            $student->is_blocked = !$student->is_blocked;
            $student->save();
            $i += 1;
        }
        return redirect()->back();
    }
}
