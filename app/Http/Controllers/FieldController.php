<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Field;
use App\Models\Subject;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if (Auth::user()->cannot("viewAny", Field::class)) {
            abort(403);
        }
        return view("management.fields", [
            "fields" => Field::all(),
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
        if ($request->user()->cannot("create", Field::class)) {
            abort(403);
        }
        $f = trim($request->name);
        $f = implode(" ", array_filter(explode(" ", $f)));
        $request->merge([
            "name" => strtolower($f),
        ]);
        $data = $request->validate([
            "name" => [
                "required",
                function ($attribute, $value, $fail) use ($request) {
                    if (
                        Field::where("name", $request->name)
                            ->where("department_id", $request->department_id)
                            ->first() !== null
                    ) {
                        $fail("رشته ای با این نام و بخش وجود دارد");
                    }
                },
            ],
            "department_id" => "required",
        ]);
        $field = new Field();
        $field->fill($data);
        $field->save();

        $subject = new Subject();
        $subject->name = $field->name;
        $subject->image_name = null;
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        if (Auth::user()->cannot("create", Field::class)) {
            abort(403);
        }
        return view("management.fields", [
            "fields" => Field::all(),
            "departments" => Department::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     * @return Application|Factory|View
     */
    public function edit()
    {
        return view("management.fields", [
            "fields" => Field::all(),
            "departments" => Department::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        if (
            $request
                ->user()
                ->cannot("update", Field::find($request["field_id"]))
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
                        Field::where("name", $request->name)
                            ->where("department_id", $request->department_id)
                            ->where("id", "<>", $request->field_id)
                            ->first() !== null
                    ) {
                        $fail("رشته ای با این نام و بخش وجود دارد");
                    }
                },
            ],
            "department_id" => "required",
            "field_id" => "required",
        ]);
        Field::where("id", $data["field_id"])->update([
            "name" => $data["name"],
            "department_id" => $data["department_id"],
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Field $field
     * @return RedirectResponse
     */
    public function destroy(Field $field): RedirectResponse
    {
        if (Auth::user()->cannot("forceDelete", $field)) {
            abort(403);
        }
        $field->delete();
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
        if (Auth::user()->cannot("forceDelete", Field::class)) {
            abort(403);
        }
        Field::whereIn("id", $request)->delete();
        return redirect()->back();
    }
}
