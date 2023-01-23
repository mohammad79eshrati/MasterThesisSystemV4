<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Professor;
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

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if (Auth::user()->cannot("viewAny", Professor::class)) {
            abort(403);
        }
        return view("management.professors", [
            "professors" => Professor::all(),
            "departments" => Department::all(),
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
        if ($request->user()->cannot("create", Professor::class)) {
            abort(403);
        }
        $data = $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email",
            "password" => ["required", 'min:6'],
            "confirm_password" => "required|same:password",
            "birth_date" => "required|date",
            "department_id" => "required",
            "prof_id" => "required|unique:professors",
        ]);
        $user = new User();
        $user->first_name = $data["first_name"];
        $user->last_name = $data["last_name"];
        $user->email = $data["email"];
        $birth_date = date($data["birth_date"]);
        $user->birth_date = date_create($birth_date);
        $user->password = Hash::make($data["password"]);
        $user->role = "professor";
        $user->save();

        $professor = new Professor();
        $professor->prof_id = $data["prof_id"];
        $professor->department_id = $data["department_id"];
        $professor->user_id = $user->id;
        $professor->save();
        if ($request->ajax()) {
            return response()->json(["prof_id" => $professor->prof_id]);
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
        if (Auth::user()->cannot("create", Professor::class)) {
            abort(403);
        }
        return view("management.professors", [
            "professors" => Professor::all(),
            "departments" => Department::all(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Professor $professor
     * @return Response
     */
    public function show(Professor $professor)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param Professor $professor
     * @return RedirectResponse
     */
    public function block(Professor $professor)
    {
        if (Auth::user()->cannot("update", $professor)) {
            abort(403);
        }
        $professor->is_blocked = true;
        $professor->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Professor $professor
     * @return RedirectResponse
     */
    public function unblock(Professor $professor)
    {
        if (Auth::user()->cannot("update", $professor)) {
            abort(403);
        }
        $professor->is_blocked = false;
        $professor->save();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Professor $professor
     * @return Application|Factory|View
     */
    public function edit(Professor $professor)
    {
        if (Auth::user()->cannot("update", $professor)) {
            abort(403);
        }
        return view("management.professors", [
            "professors" => Professor::all(),
            "departments" => Department::all(),
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
        if (
            $request
                ->user()
                ->cannot("update", Professor::find($request["prof_id"]))
        ) {
            abort(403);
        }
        //        dd($request);
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
                        $fail("دانشجویی با این ایمیل وجود دارد");
                    }
                },
            ],
            "birth_date" => "required|date",
            "user_id" => "required",
            "prof_id" => [
                "required",
                function ($attribute, $value, $fail) use ($request) {
                    if (
                        Professor::where("prof_id", $request->prof_id)
                            ->where("user_id", "<>", $request->user_id)
                            ->first() !== null
                    ) {
                        $fail("استادی با این شناسه وجود دارد");
                    }
                },
            ],
            "department_id" => "required",
        ]);
        if (isset($data["prof_id"])) {
            $professor = Professor::find($data["prof_id"]);
            $professor->department_id = $data["department_id"];
            $professor->save();

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
     * @param Professor $professor
     * @return RedirectResponse
     */
    public function destroy(Professor $professor)
    {
        if (Auth::user()->cannot("forceDelete", $professor)) {
            abort(403);
        }
        $professor->user->delete();
        $professor->delete();
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
        if ($request->user()->cannot("forceDelete", Professor::class)) {
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
            $professor = Professor::where("user_id", $request[$i])->first();
            if ($request->user()->cannot("update", $professor)) {
                abort(403);
            }
            $professor->is_blocked = !$professor->is_blocked;
            $professor->save();
            $i += 1;
        }
        return redirect()->back();
    }
}
