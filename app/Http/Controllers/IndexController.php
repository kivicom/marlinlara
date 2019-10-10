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
        $comments = $this->comments->list(1,'created_at', 'desc', 5);
        return view('index', ['comments' => $comments]);
    }
}
