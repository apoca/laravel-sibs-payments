<?php

namespace Apoca\Sibs\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class Sibs
 *
 * @package Apoca\Sibs\Facade
 */
class Sibs extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'sibs';
    }
}
