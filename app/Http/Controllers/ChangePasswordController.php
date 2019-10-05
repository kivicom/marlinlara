<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'current' => ['required', 'min:8', new MatchOldPassword],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['same:password'],
        ]);

        User::find(Auth::user()->id)->update(['password'=> Hash::make($request->password)]);
        Session::flash('profile_pass', 'Пароль успешно обновлен!');
        return redirect('/profile');
    }
}
