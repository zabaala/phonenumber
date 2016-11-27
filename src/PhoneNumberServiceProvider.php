<?php

namespace Zabaala\PhoneNumber;

use Illuminate\Support\ServiceProvider;

class PhoneNumberServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    public $defer = true;

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->bind('phonenumber', function(){
            return new PhoneNumber();
        });

        $this->app->alias('phonenumber', 'Zabaala\PhoneNumber\PhoneNumber');
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ['phonenumber'];
    }


}