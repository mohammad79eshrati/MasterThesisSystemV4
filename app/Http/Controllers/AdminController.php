<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if (Auth::user()->cannot("viewAny", Admin::class)) {
            abort(403);
        }
        return view("management.admins", ["admins" => Admin::where("id","<>",Auth::user()->admin->id)->where("is_owner",0)->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return string
     */
    public function store(
        Request $request
    )
    {
        if ($request->user()->cannot("create", Admin::class)) {
            abort(403);
        }
        $data = $request->validate([
            "first_name" => "required ",
            "last_name" => "required",
            "email" => "required|unique:users|email",
            "password" => ["required","min:6"],
            "confirm_password" => "required|same:password",
            "birth_date" => "required|date",
        ]);
        $user = new User();
        $user->first_name = $data["first_name"];
        $user->last_name = $data["last_name"];
        $user->email = $data["email"];
        $birth_date = date($data["birth_date"]);
        $user->birth_date = date_create($birth_date);
        $user->password = Hash::make($data["password"]);
        $user->role = "admin";
        $user->save();

        $admin = new Admin();
        $admin->user_id = $user->id;
        $admin->save();

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        if (Auth::user()->cannot("create", Admin::class)) {
            abort(403);
        }
        return view("management.admins", ["admins" => Admin::where("id","<>",Auth::user()->admin->id)->where("is_owner",0)->get()]);
    }

    /**
     * Display the specified resource.
     *
     * @param Admin $admin
     * @return Response
     */
    public function show(Admin $admin)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param Admin $admin
     * @return RedirectResponse
     */
    public function block(Admin $admin)
    {
        if (Auth::user()->cannot("update", $admin)) {
            abort(403);
        }
        $admin->is_blocked = true;
        $admin->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Admin $admin
     * @return RedirectResponse
     */
    public function unblock(Admin $admin)
    {
        if (Auth::user()->cannot("update", $admin)) {
            abort(403);
        }
        $admin->is_blocked = false;
        $admin->save();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Admin $admin
     * @return Application|Factory|View
     */
    public function edit(Admin $admin)
    {
        if (Auth::user()->cannot("update", $admin)) {
            abort(403);
        }
        return view("management.admins", ["admins" => Admin::where("id","<>",Auth::user()->admin->id)->where("is_owner",0)->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Admin $admin
     * @return RedirectResponse
     */
    public function update(Request $request, Admin $admin)
    {
        if ($request->user()->cannot("update", $admin)) {
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
                        $fail("کاربری با این ایمیل وجود دارد");
                    }
                },
            ],
            "birth_date" => "required|date",
            "user_id" => "required",
        ]);
        $user = User::find($data["user_id"]);
        $user->first_name = $data["first_name"];
        $user->last_name = $data["last_name"];
        $user->email = $data["email"];
        $user->birth_date = date_create(date($data["birth_date"]));
        $user->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Admin $admin
     * @return RedirectResponse
     */
    public function destroy(Admin $admin)
    {
        if (Auth::user()->cannot("forceDelete", $admin)) {
            abort(403);
        }
        $admin->user->delete();
        $admin->delete();
        return redirect(route('admins'));
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
        if ($request->user()->cannot("forceDelete", Admin::class)) {
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
            $admin = Admin::where("user_id", $request[$i])->first();
            if ($request->user()->cannot("update", $admin)) {
                abort(403);
            }
            $admin->is_blocked = !$admin->is_blocked;
            $admin->save();
            $i += 1;
        }
        return redirect()->back();
    }
}
