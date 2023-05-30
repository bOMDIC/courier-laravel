<?php

namespace GoMore\LaravelCourier\Facades;

use Illuminate\Support\Facades\Facade;

class Courier extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'Courier';
    }
}
