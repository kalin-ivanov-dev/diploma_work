<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public  function index()
    {
        return view('user.profile',[
            'user' => User::where('id',auth()->id())->get()->first(),
        ]);
    }

    public function  edit(User $user)
    {
        return view('user.edit-profile',[
            'user' => User::where('id',auth()->id())->get()->first(),
        ]);
    }

}
