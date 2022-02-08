<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminCommentsController extends Controller
{
    public function edit(Comment $comment)
    {
        return view('admin.posts.comments.edit',['comment'=> $comment]);
    }

    public function update(Comment $comment,Request $request)
    {
        $request->validate([
            'body' => 'required|string|min:3|max:255'
        ]);

        if(!$request['is_approved'])
            $request['is_approved'] = 0;

        $comment->update([
            'user_id' => $comment->author()->first()->id,
            'is_active' => $request['is_approved'],
            'body' => $request['body'],
        ]);

        return back()->with('success','Comment successfully updated');
    }
}
