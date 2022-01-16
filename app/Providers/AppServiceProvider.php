<?php

namespace App\Providers;

use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use App\Services\NewsletterInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;
use Symfony\Component\HttpFoundation\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application Services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(NewsletterInterface::class,function(){
            $client  = new ApiClient();

            $client->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us20'
            ]);
             return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application Services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('user',function (User $user){

        });
    }
}
