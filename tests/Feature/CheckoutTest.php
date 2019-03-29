<?php

namespace Apoca\Sibs\Tests\Feature;

use Apoca\Sibs\Tests\TestCase;
use Apoca\Sibs\Facade\Sibs;

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
            'type' => 'DB'
        ];

        $response = Sibs::checkout($request)->pay();

        $this->assertSame($response->status, 200);
    }
}
