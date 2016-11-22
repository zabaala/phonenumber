<?php

namespace Zabaala\PhoneNumber;

use Illuminate\Support\Facades\Facade;

class PhoneNumberFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'phonenumber';
    }
}