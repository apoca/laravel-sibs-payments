<?php

namespace Apoca\Sibs\Tests\Feature;

use Apoca\Sibs\Tests\TestCase;
use Apoca\Sibs\Facade\Sibs;

/**
 * Class CheckoutTest
 *
 * @package Apoca\Sibs\Tests\Feature
 */
class SibsServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function verifyResponseStatusInvalidEntity(): void
    {
        $request = [
            'brand' => 'CHECKOUT',
            'amount' => 100,
            'currency' => 'EUR',
            'type' => 'DB'
        ];

        $response = Sibs::checkout($request)->pay();
        $response2 = Sibs::status($response->response->id);

        $this->assertSame($response->status, 200);
        $this->assertSame($response2->status, 200);
    }
}
