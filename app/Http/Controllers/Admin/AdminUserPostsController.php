<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserPostsController extends Controller
{
    public  function index(User $user)
    {
        return view('admin.user-posts',[
            'posts' => $user->posts()->get(),
            'user' => $user
        ]);
    }
}
