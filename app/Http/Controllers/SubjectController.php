<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Subject;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if (Auth::user()->cannot("viewAny", Subject::class)) {
            abort(403);
        }
        return view("management.subjects", [
            "subjects" => Subject::all(),
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
        if ($request->user()->cannot("create", Subject::class)) {
            abort(403);
        }
        $s = trim($request->name);
        $s = implode(" ", array_filter(explode(" ", $s)));
        $request->merge([
            "name" => strtolower($s),
        ]);
        //        dd($request);
        $data = $request->validate([
            "name" => [
                "required",
                function ($attribute, $value, $fail) use ($request) {
                    if (
                        Subject::where("name", $request->name)
                            ->where("field_id", $request->field_id)
                            ->first() !== null
                    ) {
                        $fail("موضوعی با این نام و رشته وجود دارد");
                    }
                },
            ],
            "field_id" => "required",
            "subject-img" => "image|nullable",
            "is_ajax" => "nullable",
        ]);
        $subject = new Subject();
        $subject->name = $data["name"];
        $subject->field_id = $data["field_id"];
        if (isset($data["subject-img"])) {
            $file = $data["subject-img"];
            $name = $file->hashName();
            Storage::disk("public")->putFileAs("/images", $file, $name);

            $subject->image_name = $name;
        }
        $subject->save();

        if (isset($data["is_ajax"])) {
            return response()->json(["subject_id" => $subject->id]);
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
        if (Auth::user()->cannot("create", Subject::class)) {
            abort(403);
        }
        return view("management.subjects", [
            "subjects" => Subject::all(),
            "fields" => Field::all(),
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
        if (Auth::user()->cannot("update", Subject::class)) {
            abort(403);
        }
        return view("management.subjects", [
            "subjects" => Subject::all(),
            "fields" => Field::all(),
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
                ->cannot("update", Subject::find($request["subject_id"]))
        ) {
            abort(403);
        }
        $s = trim($request->name);
        $s = implode(" ", array_filter(explode(" ", $s)));
        $request->merge([
            "name" => strtolower($s),
        ]);
        $data = $request->validate([
            "name" => [
                "required",
                function ($attribute, $value, $fail) use ($request) {
                    if (
                        Subject::where("name", $request->name)
                            ->where("field_id", $request->field_id)
                            ->where("id", "<>", $request->subject_id)
                            ->first() !== null
                    ) {
                        $fail("موضوعی با این نام و رشته وجود دارد");
                    }
                },
            ],
            "field_id" => "required",
            "subject-img" => "nullable|image",
            "subject_id" => "required",
        ]);
        if (isset($data["subject-img"])) {
            $img = $data["subject-img"];
            $subject = Subject::find($data["subject_id"]);
            if ($subject->image_name !== null) {
                Storage::disk("public")->delete(
                    "images/" . $subject->image_name
                );
            }
            $name = $img->hashName();
            Storage::disk("public")->putFileAs("/images", $img, $name);
            $subject->name = $data["name"];
            $subject->field_id = $data["field_id"];
            $subject->image_name = $name;
            $subject->save();
        } else {
            Subject::where("id", $data["subject_id"])->update([
                "name" => $data["name"],
                "field_id" => $data["field_id"],
            ]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Subject $subject
     * @return RedirectResponse
     */
    public function destroy(Subject $subject): RedirectResponse
    {
        if (Auth::user()->cannot("forceDelete", $subject)) {
            abort(403);
        }
        Storage::disk("public")->delete("images/" . $subject->image_name);
        $subject->delete();
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
        $i = 1;
        while ($request->has((string) $i)) {
            $subject = Subject::find($request[$i]);
            if (Auth::user()->cannot("forceDelete", $subject)) {
                abort(403);
            }
            Storage::disk("public")->delete("images/" . $subject->image_name);
            $subject->delete();
            $i += 1;
        }
        return redirect()->back();
    }
}
