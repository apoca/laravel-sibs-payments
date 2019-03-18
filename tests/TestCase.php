<?php

namespace Apoca\Sibs\Tests;

use Illuminate\Support\Facades\Facade;
use Mockery as m;
use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * Class TestCase
 *
 * @package Apoca\Sibs\Tests
 */
class TestCase extends BaseTestCase
{
    public function tearDown(): void
    {
        Facade::clearResolvedInstances();
        parent::tearDown();
        m::close();
    }
}
