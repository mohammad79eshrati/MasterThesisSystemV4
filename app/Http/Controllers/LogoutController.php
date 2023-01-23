<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function logout(
        Request $request
    ) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect("/");
    }
}
