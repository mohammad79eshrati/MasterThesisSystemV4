<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if (Auth::user()->cannot("viewAny", Department::class)) {
            abort(403);
        }
        return view("management.departments", [
            "departments" => Department::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(
        Request $request
    )  {
        if ($request->user()->cannot("create", Department::class)) {
            abort(403);
        }
        $d = trim($request->name);
        $d = implode(" ", array_filter(explode(" ", $d)));
        $request->merge([
            "name" => strtolower($d),
        ]);
        $data = $request->validate([
            "name" => "required|unique:departments",
        ]);
        $department = new Department();
        $department->name = $data["name"];
        $department->save();
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        if (Auth::user()->cannot("create", Department::class)) {
            abort(403);
        }
        return view("management.departments", [
            "departments" => Department::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Department $department
     * @return Application|Factory|View
     */
    public function edit(Department $department)
    {
        if (Auth::user()->cannot("update", $department)) {
            abort(403);
        }
        return view("management.departments", [
            "departments" => Department::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Department $department
     * @return RedirectResponse
     */
    public function update(
        Request $request,
        Department $department
    ): RedirectResponse {
        if (
            $request
                ->user()
                ->cannot("update", Department::find($request["department_id"]))
        ) {
            abort(403);
        }
        $k = trim($request->name);
        $k = implode(" ", array_filter(explode(" ", $k)));
        $request->merge([
            "name" => strtolower($k),
        ]);
        $data = $request->validate([
            "name" => [
                "required",
                function ($attribute, $value, $fail) use ($request) {
                    if (
                        Department::where("name", $request->name)
                            ->where("id", "<>", $request->department_id)
                            ->first() !== null
                    ) {
                        $fail("بخشی با این نام وجود دارد");
                    }
                },
            ],
            "department_id" => "required",
        ]);
        Department::where("id", $data["department_id"])->update([
            "name" => $data["name"],
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Department $department
     * @return RedirectResponse
     */
    public function destroy(Department $department): RedirectResponse
    {
        if (Auth::user()->cannot("forceDelete", $department)) {
            abort(403);
        }
        $department->delete();
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
    )  {
        if ($request->user()->cannot("forceDelete", Department::class)) {
            abort(403);
        }

        Department::whereIn("id", $request)->delete();
        return redirect()->back();
    }
}
