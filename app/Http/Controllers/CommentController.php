<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $this->validateComent($request);
        $insert = Comment::store($request);
        if(!$insert->id){
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
