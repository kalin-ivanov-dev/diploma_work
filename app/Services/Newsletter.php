<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class Newsletter{
    public  function subscribe(string $email,string $list = null)
    {
       $list =  ($list === null ) ? (string) config('services.mailchimp.lists.subscribers') : (string) $list;

        return $this->getClient()->lists->addListMember($list,[
            'email_address' => request('email'),
            'status' => 'subscribed'
        ]);

    }

    protected  function  getClient()
    {
        $mailchimp = new ApiClient();

        return $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us20'
        ]);
    }

}
