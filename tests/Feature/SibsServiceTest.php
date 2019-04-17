<?php

namespace Apoca\Sibs\Tests\Feature;

use Apoca\Sibs\Facade\Sibs;
use Apoca\Sibs\Tests\TestCase;

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
            'type' => 'DB',
            'optionalParameters' => [],
        ];

        $response = Sibs::checkout($request)->pay();
        $response2 = Sibs::status($response->response->id);

        $this->assertSame($response->status, 200);
        $this->assertSame($response2->status, 200);
    }
}
