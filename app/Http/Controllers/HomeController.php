<?php

namespace App\Http\Controllers;

use App\Models\Defense;
use App\Models\Subject;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $user = Auth::user();
        $defenses = collect(Defense::all());
        if ($user->role === "professor") {
            $pid = $user->professor->department->id;
            $recentDefenses = $defenses
                ->filter(function ($defense) use ($pid) {
                    return $defense->subject->field->department->id === $pid ||
                        $defense->professor->department->id === $pid ||
                        $defense->student->field->department->id === $pid;
                })
                ->sortByDesc("date");
        } elseif ($user->role === "student") {
            $field = $user->student->field;
            $recentDefenses = $defenses
                ->filter(function ($defense) use ($field) {
                    return $defense->subject->field->id === $field->id ||
                        $defense->professor->department->id ===
                        $field->department->id ||
                        $defense->student->field->department->id ===
                        $field->department->id;
                })
                ->sortByDesc("date");
        } else {
            $recentDefenses = $defenses->sortByDesc("date");
        }

        $recentSubjects = collect(
            Subject::whereNotIn(
                "id",
                collect($user->interests)->pluck("id")
            )->get()
        );
        $recentSubjects = $recentSubjects->sortByDesc("created_at");

        $recentSubjects = $recentSubjects->sortByDesc(function ($subject) {
            return subjectSimilarity(Auth::user(), $subject);
        });
        $recentSubjects = $recentSubjects->slice(0, 20);

        $favoriteDefenses = collect(Defense::all())->sortByDesc(function (
            $defense
        ) {
            return similarityAnalyzer($defense, Auth::user());
        });
        return view("home", [
            "recentSubjects" => $recentSubjects,
            "recentDefenses" => $recentDefenses->slice(0, 20),
            "favoriteDefenses" => $favoriteDefenses,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index_management()
    {

        return view("management.home", [

        ]);
    }
}
