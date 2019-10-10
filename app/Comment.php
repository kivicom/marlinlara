<?php

namespace App;

use Hamcrest\Thingy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    protected $fillable = [
        'name', 'text', 'user_id',
    ];

    /**
     * A User can has many Comments
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        '_token',
    ];

    public static function store($request)
    {
        return Comment::create([
            'user_id' => Auth::id(),
            'name' => $request['name'],
            'text' => $request['text'],
            'date' => now(),
        ]);
    }

    public function list($status, $orderBy, $order, $perPage)
    {
        return Comment::where('published',$status)->orderBy($orderBy, $order)->paginate($perPage);
    }

    public function adminManageComment($published, $id_comment, Request $request)
    {
        if ($request->has('published')) {
            return $this->adminCommentUpdate($published, $id_comment);
        }
        if ($request->has('remove')) {
            return $this->adminCommentDelete($id_comment);
        }
        return false;
    }

    public function adminCommentUpdate($published, $id_comment)
    {
        return Comment::where('id', $id_comment)->update(['published' => $published]);
    }

    public function adminCommentDelete($id_comment)
    {
        return Comment::where('id', $id_comment)->delete();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
