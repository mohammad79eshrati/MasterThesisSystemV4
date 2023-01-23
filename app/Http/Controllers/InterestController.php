<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view("interests");
    }

    /**
     * Show the form for creating a new resource.
     * @param Subject $subject
     * @return Response|null
     */
    public function add(Subject $subject): ?Response
    {
        Auth::user()
            ->interests()
            ->attach($subject);
        return null;
    }

    /**
     * Show the form for creating a new resource.
     * @param Subject $subject
     * @return Response|null
     */
    public function remove(Subject $subject): ?Response
    {
        Auth::user()
            ->interests()
            ->detach($subject);
        return null;
    }
}
