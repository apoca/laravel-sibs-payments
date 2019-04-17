<?php

namespace Apoca\Sibs\Tests\Feature;

use Apoca\Sibs\Facade\Sibs;
use Apoca\Sibs\Tests\TestCase;

/**
 * Class CheckoutTest
 *
 * @package Apoca\Sibs\Tests\Feature
 */
class CheckoutTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function verifyResponseCheckoutSuccess(): void
    {
        $request = [
            'brand' => 'CHECKOUT',
            'amount' => 100,
            'currency' => 'EUR',
            'type' => 'DB',
            'optionalParameters' => [],
        ];

        $response = Sibs::checkout($request)->pay();

        $this->assertSame($response->status, 200);
    }
}
