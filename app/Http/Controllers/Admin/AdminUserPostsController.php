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

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success','User Deleted Successfully');
    }

    public function edit(User $user)
    {
        return  view('admin.edit-user',[
            'user' => $user
        ]);
    }

    public function  update(User $user)
    {
        $attributes =  $this->validateUser($user);

        if(isset($attributes['profile_picture']))
        {
            $attributes['profile_picture'] = \request()->file('profile_picture')->store('user_pictures');
        }

        if(!isset($attributes['is_admin']))
        {
            $attributes['is_admin'] = 0;
        }

        $user->update($attributes);

        return redirect('admin/dashboard')->with('success','User Updated');

    }

    protected  function validateUser(?User $user = null) : array
    {
        $user  = $user ?? null;

        return \request()->validate([
            'username' => $user->exists ? ['min:3','max:255'] : ['required','min:3','max:255','unique:users,username'],
            'profile_picture' => $user->profile_picture ? ['image'] : ['required','image'],
            'email' =>  $user->exists ? ['email'] : ['required','email','max:255','unique:users,email'],
            'is_admin' => 'boolean',
        ]);

    }

}
