<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public  function  __invoke(Newsletter  $newsletter)
    {
        request()->validate(['email' =>  'required|email']);

//    $response = $mailchimp->lists->getList('1603e06611');
//    $response = $mailchimp->lists->getListMembersInfo('1603e06611');

        try {
            $newsletter->subscribe(request('email'));
        }catch (Exception $e)
        {
            throw ValidationException::withMessages([
                'email' =>  'This email could not be added to our newsletter list.'
            ]);
        }


        return redirect('/')->with('success','Your are now signed up for our newsletter');

    }

}
