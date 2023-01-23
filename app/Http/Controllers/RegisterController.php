<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|unique:users",
            "password" => "required",
            "confirm_password" => "required",
            "birth_date" => "required|date",
            "field_id" => "required",
            "std_num" => "required|unique:students",
            "remember_me" => "required",
        ]);
        if ($data["password"] === $data["confirm_password"]) {
            $user = new User();
            $user->first_name = $data["first_name"];
            $user->last_name = $data["last_name"];
            $user->email = $data["email"];
            $birth_date = date($data["birth_date"]);
            $user->birth_date = date_create($birth_date);
            $user->password = Hash::make($data["password"]);
            $user->role = "student";
            $user->save();

            $student = new Student();
            $student->std_num = $data["std_num"];
            $student->field_id = $data["field_id"];
            $student->user_id = $user->id;
            $student->save();

            $credentials = [
                "email" => $data["email"],
                "password" => $data["password"],
            ];
            if (Auth::attempt($credentials, $data["remember_me"])) {
                // Authentication passed...
                return redirect(route("home"));
            }
            return redirect()
                ->back()
                ->withErrors([
                    "error" =>
                        "احراز هویت شما با خطا مواجه شد، دوباره امتحان کنید",
                ]);
        }

        return redirect()
            ->back()
            ->withErrors(["error" => "رمز و تایید رمز متفاوت می باشند."]);
    }
}
