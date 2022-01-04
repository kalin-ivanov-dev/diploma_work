<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public  function  destroy()
    {
//        dd(auth());
        auth()->logout();

//        $username = auth()->user()->name;
        return redirect('/')->with('success',"Goodbye");
    }

    public  function  create()
    {
        return view('sessions.create');
    }

    public  function  store()
    {
       $attributes =  request()->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // attempts login
        if(!auth()->attempt($attributes)){
            throw ValidationException::withMessages(
                ['email' => "Your provided credentials could not be verified."]);
        }



        session()->regenerate();
        return redirect('/')->with('success','Welcome back');
    }
}
