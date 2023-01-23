<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class KeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if (Auth::user()->cannot("viewAny", Keyword::class)) {
            abort(403);
        }
        return view("management.keywords", ["keywords" => Keyword::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(
        Request $request
    ) {
        if ($request->user()->cannot("create", Keyword::class)) {
            abort(403);
        }
        $k = trim($request->name);
        $k = implode(" ", array_filter(explode(" ", $k)));
        $request->merge([
            "name" => strtolower($k),
        ]);
        $data = $request->validate([
            "name" => "required|unique:keywords",
        ]);
        $keyword = new Keyword();
        $keyword->name = $data["name"];
        $keyword->save();
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        if (Auth::user()->cannot("create", Keyword::class)) {
            abort(403);
        }

        return view("management.keywords", ["keywords" => Keyword::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Keyword $keyword
     * @return Application|Factory|View
     */
    public function edit(Keyword $keyword)
    {
        if (Auth::user()->cannot("update", $keyword)) {
            abort(403);
        }
        return view("management.keywords", ["keywords" => Keyword::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Keyword $keyword
     * @return RedirectResponse
     */
    public function update(Request $request, Keyword $keyword): RedirectResponse
    {
        if ($request->user()->cannot("update", $keyword)) {
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
                        Keyword::where("name", $request->name)
                            ->where("id", "<>", $request->keyword_id)
                            ->first() !== null
                    ) {
                        $fail("کلمه کلیدیی با این نام وجود دارد");
                    }
                },
            ],
            "keyword_id" => "required",
        ]);
        Keyword::where("id", $data["keyword_id"])->update([
            "name" => $data["name"],
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Keyword $keyword
     * @return RedirectResponse
     */
    public function destroy(Keyword $keyword): RedirectResponse
    {
        if (Auth::user()->cannot("forceDelete", $keyword)) {
            abort(403);
        }
        $keyword->delete();
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
    ) {
        if ($request->user()->cannot("forceDelete", Keyword::class)) {
            abort(403);
        }
        Keyword::whereIn("id", $request)->delete();
        return redirect()->back();
    }
}
