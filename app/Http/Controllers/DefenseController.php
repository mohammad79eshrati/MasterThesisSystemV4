<?php

namespace App\Http\Controllers;

use App\Jobs\NotifyUsers;
use App\Models\Defense;
use App\Models\Department;
use App\Models\Field;
use App\Models\Keyword;
use App\Models\Professor;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class DefenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if (Auth::user()->cannot("viewAny", Defense::class)) {
            abort(403);
        }
        return view("management.defenses");
    }

    /**
     * Display a listing of the resource.
     *
     * @param Subject $subject
     * @return Application|Factory|View
     */
    public function subject_index(Subject $subject)
    {
        if (Auth::user()->cannot("viewAny", Defense::class)) {
            abort(403);
        }
        return view("subject_defenses", ["subject" => $subject]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Keyword $keyword
     * @return Application|Factory|View
     */
    public function keyword_index(Keyword $keyword)
    {
        if (Auth::user()->cannot("viewAny", Defense::class)) {
            abort(403);
        }
        return view("keyword_defenses", ["keyword" => $keyword]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Field $field
     * @return Application|Factory|View
     */
    public function field_subjects(Field $field)
    {
        if (Auth::user()->cannot("viewAny", Defense::class)) {
            abort(403);
        }
        return view("field_subjects", ["field" => $field]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Professor $professor
     * @return Application|Factory|View
     */
    public function professor_index(
        Professor $professor
    )
    {
        if (Auth::user()->cannot("viewAny", Defense::class)) {
            abort(403);
        }
        return view("professor_defenses", ["professor" => $professor]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Department $department
     * @return Application|Factory|View
     */
    public function department_index(
        Department $department
    )
    {
        if (Auth::user()->cannot("viewAny", Defense::class)) {
            abort(403);
        }
        return view("department_defenses", ["department" => $department]);
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @return Application|Factory|View
     */
    public function fields_index()
    {
        if (Auth::user()->cannot("viewAny", Defense::class)) {
            abort(403);
        }
        return view("fields_defenses");
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index_deleted()
    {
        if (Auth::user()->cannot("forceDelete", Defense::class)) {
            abort(403);
        }
        return view("management.defenses_deleted");
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function mine()
    {
        if (Auth::user()->cannot("viewAny", Defense::class)) {
            abort(403);
        }

        return view("my_defenses");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        if (Auth::user()->cannot("create", Defense::class)) {
            abort(403);
        }
        return view("defense_create", [
            "subjects" => Subject::all(),
            "keywords" => Keyword::all(),
            "professors" => Professor::all(),
            "students" => Student::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->cannot("create", Defense::class)) {
            abort(403);
        }
        $request->merge([
            "date" => date($request->date),
        ]);
        $data = $request->validate([
            "title" => "required",
            "subject_id" => "required",
            "date" => "required|date",
            "time" => "required|date_format:H:i",
            "place" => "required",
            "is_online" => "nullable",
            "prof_id" => "required",
            "std_num" => [
                "required",
                function ($attribute, $value, $fail) use ($request) {
                    if (
                        Defense::where(
                            "std_num",
                            $request->std_num
                        )->first() !== null
                    ) {
                        $fail("در حال حاضر دفاعی برای این دانشجو وجود دارد");
                    }
                },
            ],
            "keywords" => "required",
            "abstract" => "nullable",
        ]);

        $defense = new Defense();
        $defense->title = $data["title"];
        $defense->subject_id = $data["subject_id"];
        $defense->date = $data["date"];
        $defense->time = $data["time"];
        $defense->place = $data["place"];
        if (isset($data["is_online"])) {
            $defense->is_online = true;
        } else {
            $defense->is_online = false;
        }
        $defense->prof_id = $data["prof_id"];
        $defense->std_num = $data["std_num"];
        $defense->abstract = $data["abstract"];
        $defense->creator_id = Auth::user()->id;
        $defense->save();

        $keywords = explode(",", $data["keywords"]);
        $keyword_ids = [];
        foreach ($keywords as $k) {
            $keyword = Keyword::where("name", $k)->first();
            if ($keyword === null) {
                $keyword = new Keyword();
                $keyword->name = $k;
                $keyword->save();
            }
            $keyword_ids[] = $keyword->id;
        }
        $defense->keywords()->attach($keyword_ids);
        NotifyUsers::dispatch($defense);
        return redirect(route('defenses.show',$defense));
    }

    /**
     * Display the specified resource.
     *
     * @param Defense $defense
     * @return Application|Factory|View
     */
    public function show(Defense $defense)
    {
        if (Auth::user()->cannot("view", $defense)) {
            abort(403);
        }
        return view("defense_detail", ["defense" => $defense]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Defense $defense
     * @return Application|Factory|View
     */
    public function edit(Defense $defense)
    {
        if (Auth::user()->cannot("update", $defense)) {
            abort(403);
        }
        return view("defense_edit", ["defense" => $defense]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Defense $defense
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, Defense $defense)
    {
        if ($request->user()->cannot("update", $defense)) {
            abort(403);
        }
        $request->merge([
            "date" => date($request->date),
        ]);
        $data = $request->validate([
            "title" => "required",
            "subject_id" => "required",
            "date" => "required|date",
            "time" => "required|date_format:H:i",
            "place" => "required",
            "is_online" => "nullable",
            "prof_id" => "required",
            "std_num" => [
                "required",
                function ($attribute, $value, $fail) use ($defense, $request) {
                    if (
                        Defense::where("std_num", $request->std_num)
                            ->where("id", "<>", $defense->id)
                            ->first() !== null
                    ) {
                        $fail("در حال حاضر دفاعی برای این دانشجو وجود دارد");
                    }
                },
            ],
            "keywords" => "required",
            "abstract" => "nullable",
        ]);

        $defense->title = $data["title"];
        $defense->subject_id = $data["subject_id"];
        $defense->date = $data["date"];
        $defense->time = $data["time"];
        $defense->place = $data["place"];
        if (isset($data["is_online"])) {
            $defense->is_online = true;
        } else {
            $defense->is_online = false;
        }
        $defense->prof_id = $data["prof_id"];
        $defense->std_num = $data["std_num"];
        $defense->abstract = $data["abstract"];
        $defense->save();

        $defense->keywords()->detach();
        $keywords = explode(",", $data["keywords"]);
        $keyword_ids = [];
        foreach ($keywords as $k) {
            $k = trim($k);
            $k = implode(" ", array_filter(explode(" ", $k)));
            $keyword = Keyword::where("name", $k)->first();
            if ($keyword === null) {
                $keyword = new Keyword();
                $keyword->name = $k;
                $keyword->save();
            }
            if (!in_array($keyword->id, $keyword_ids)) {
                $keyword_ids[] = $keyword->id;
            }
        }
        $defense->keywords()->attach($keyword_ids);
        return redirect(route('defenses.show',$defense));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Defense $defense
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(Defense $defense)
    {
        if (Auth::user()->cannot("delete", $defense)) {
            abort(403);
        }
        // TODO if you used force delete uncomment this line
        //        $defense->keywords()->detach();
        $defense->delete();

        if (url()->previous() === route('defenses.show',$defense)){
            return redirect(route('home'));
        }
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
        if ($request->user()->cannot("delete", Defense::class)) {
            abort(403);
        }

        Defense::whereIn("id", $request)->delete();
        return redirect()->back();
    }




}
