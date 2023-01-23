<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Professor;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            "id" => ["required"],
            "password" => ["required"],
        ]);

        if(Auth::attempt(['email' => $credentials["id"], 'password' => $credentials["password"]],$request->remember_me)){
            if (Auth::user()->isNotBanned()){
            $request->session()->regenerate();

            return redirect()->intended(route("home"));
            }

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return back()
                ->withErrors([
                    "error" => "حساب کاربری شما مسدود می باشد.",
                ]);
        }

        $admin = Admin::find($credentials["id"]);
        if ($admin) {
            if(Auth::attempt(['id' => $admin->user->id, 'password' => $credentials["password"]],$request->remember_me)){
                if (Auth::user()->isNotBanned()){
                    $request->session()->regenerate();

                    return redirect()->intended(route("home"));
                }

                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return back()
                    ->withErrors([
                        "error" => "حساب کاربری شما مسدود می باشد.",
                    ]);
            }
        }

        $professor = Professor::find($credentials["id"]);
        if ($professor) {
            if(Auth::attempt(['id' => $professor->user->id, 'password' => $credentials["password"]],$request->remember_me)){


                if (Auth::user()->isNotBanned()){
                    $request->session()->regenerate();

                    return redirect()->intended(route("home"));
                }

                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return back()
                    ->withErrors([
                        "error" => "حساب کاربری شما مسدود می باشد.",
                    ]);
            }
        }

        $student = Student::find($credentials["id"]);
        if ($student) {
            if(Auth::attempt(['id' => $student->user->id, 'password' => $credentials["password"]],$request->remember_me)){

                if (Auth::user()->isNotBanned()){
                    $request->session()->regenerate();

                    return redirect()->intended(route("home"));
                }

                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();
                return back()
                    ->withErrors([
                        "error" => "حساب کاربری شما مسدود می باشد.",
                    ]);
            }


        }

        return back()
            ->withErrors([
                "email" => "نام کاربری یا کلمه عبور اشتباه می باشد",
            ])
            ->onlyInput("email");
    }
}
