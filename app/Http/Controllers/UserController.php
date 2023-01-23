<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param Admin $admin
     * @return Application|Factory|View
     */
    public function edit(Admin $admin)
    {
        return redirect(route("profile"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Admin $admin
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        if (Auth::user()->cannot("update", $user)) {
            abort(403);
        }
        $data = $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "email" => [
                "required",
                function ($attribute, $value, $fail) use ($user) {
                    if (
                        User::where("email", $user->email)
                            ->where("id", "<>", $user->id)
                            ->first() !== null
                    ) {
                        $fail("کاربری با این ایمیل وجود دارد");
                    }
                },
            ],
            "birth_date" => "required|date",
            "profile_img" => "nullable|image",
            "email_notif" => "nullable",
            "phone_notif" => "nullable",
            "phone" => [
                "required",
                "regex: ~(0|\+98)?([ ]|-|[()]){0,2}9[1|2|3|4]([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}~",
            ],
        ]);
        $user->first_name = $data["first_name"];
        $user->last_name = $data["last_name"];
        $user->email = $data["email"];
        $user->birth_date = date_create(date($data["birth_date"]));
        if (!empty($data["phone"])) {
            $user->phone = $data["phone"];
        }

        // Checking if user wants to receive email notifications or not
        if (isset($data["email_notif"])) {
            $user->email_notif = true;
        } else {
            $user->email_notif = false;
        }

        // Checking if user wants to receive phone notifications or not
        if (isset($data["phone_notif"])) {
            $user->phone_notif = true;
        } else {
            $user->phone_notif = false;
        }

        if (isset($data["profile_img"]) && $data["profile_img"] !== null) {
            $img = $data["profile_img"];
            Storage::disk("public")->delete("images/" . $user->profile_img);
            $name = $img->hashName();
            Storage::disk("public")->putFileAs("/images", $img, $name);

            $user->profile_img = $name;
        }

        $user->save();

        return redirect()->back();
    }
}
