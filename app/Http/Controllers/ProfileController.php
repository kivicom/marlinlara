<?php

namespace App\Http\Controllers;

use App\Services\ImageService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    private $image;

    public function __construct(ImageService $imageService)
    {
        $this->middleware('auth');
        $this->image = $imageService;
    }

    public function index()
    {
        $user = User::find(Auth::id());
        return view('profile', ['user'=>$user]);
    }

    public function edit(Request $request)
    {
        $this->validator($request->all())->validate();
        $input = $request->except(['_token','image']);
        $this->image->update(Auth::id(), $request->file('image'));
        if(!User::where('id', Auth::id())->update($input)){
            Session::flash('profile', 'Ошибка обновления, попробуйте еще раз!');
        }
        Session::flash('profile', 'Профиль успешно обновлен!');
        return redirect('/profile');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }
}
