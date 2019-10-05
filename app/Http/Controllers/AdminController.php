<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public $comments;
    public function __construct(Comment $comments)
    {
        $this->middleware('admin');
        $this->comments = $comments;

    }

    public function index()
    {
        $comments = $this->comments->orderBy('created_at', 'desc')->paginate(3);
        return view('admin.admin', ['comments' => $comments]);
    }

    public function manageComment(Request $request)
    {
        $published = $request->input('published');
        $id_comment = $request->input('id');
        if($request->has('published')) {
            $this->comments->adminManageComment($published, $id_comment, $request);
        }
        if($request->has('remove')) {
            $this->comments->adminManageComment($published, $id_comment, $request);
        }
        return redirect('/admin');
    }
}
