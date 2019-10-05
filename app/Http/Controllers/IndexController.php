<?php

namespace App\Http\Controllers;


use App\Comment;

class IndexController extends Controller
{
    public $comments;

    public function __construct(Comment $comments)
    {
        $this->comments = $comments;
    }

    public function index()
    {
        $comments = $this->comments->where('published',1)->orderBy('created_at', 'desc')->paginate(3);
        return view('index', ['comments' => $comments]);
    }
}
