<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $this->validateComent($request);
        $insert = Comment::create([
            'user_id' => Auth::id(),
            'name' => $request['name'],
            'text' => $request['text'],
            'date' => now(),
        ]);
        if(!$insert){
            Session::flash('error', 'Ошибка. Комментарий не добавлен!');
            return redirect('/');
        }
        Session::flash('success', 'Комментарий успешно добавлен!');
        return redirect('/');
    }

    protected function validateComent(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'text' => 'required|string',
        ]);
    }
}
