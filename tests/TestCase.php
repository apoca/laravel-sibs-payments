<?php

namespace Apoca\Sibs\Tests;

use Apoca\Sibs\Facade\Sibs;
use Apoca\Sibs\SibsServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

/**
 * Class TestCase
 *
 * @package Apoca\Sibs\Tests
 */
class TestCase extends OrchestraTestCase
{
    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [SibsServiceProvider::class];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageAliases($app): array
    {
        return [
            'Sibs' => Sibs::class,
        ];
    }
}
