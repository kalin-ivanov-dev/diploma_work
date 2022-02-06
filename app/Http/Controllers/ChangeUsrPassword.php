<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ChangeUsrPassword extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(User $user)
    {

        return view('user.change-password',[
            'user' => $user,
        ]);
    }

    public function store(Request $request,User $user)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $user->update(['password'=> (string)$request->new_password]);
        return redirect('user/profile')->with('success','You have successfully changed your password');
    }
}
