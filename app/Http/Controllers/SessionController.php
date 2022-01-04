<?php

namespace App\Http\Controllers;

class SessionController extends Controller
{
    public  function  destroy()
    {
//        dd(auth());
        auth()->logout();

//        $username = auth()->user()->name;
        return redirect('/')->with('success',"Goodbye");
    }
}
