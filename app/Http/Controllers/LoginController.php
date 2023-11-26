<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\MyClasses\MyNumber;

class LoginController extends Controller
{
    public function index()
    {
        // $numcls = app()->make(MyNumber::class);
        // $number = $numcls->getNumber();
        $myClass = app('mycustomclass');
        $number = $myClass->getNumber();
        // あるいは、以下のようにも書けます
        // $myClass = app()->make('mycustomclass');


        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return back()->withErrors(
            [
                'message' => 'メールアドレスまたはパスワードが正しくありません。',
            ]
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(RouteServiceProvider::HOME);
    }
}
