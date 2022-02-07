<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class  AdminUserCommentsController extends Controller
{
    public  function index(User $user)
    {
        return view('admin.user.user-comments',[
            'posts' => $user->posts()->get(),
            'user' => $user,
        ]);
    }

    public function destroy(User $user,Comment $comment)
    {
//        $comment->delete();
        return back()->with('success','Comment Deleted');
    }


}
