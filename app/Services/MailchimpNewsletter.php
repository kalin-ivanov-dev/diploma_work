<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements NewsletterInterface {
    protected  $client ;
    public  function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public  function subscribe(string $email,string $list = null)
    {
       $list =  ($list === null ) ? (string) config('services.mailchimp.lists.subscribers') : (string) $list;

        return $this->client->lists->addListMember($list,[
            'email_address' => request('email'),
            'status' => 'subscribed'
        ]);

    }



}
