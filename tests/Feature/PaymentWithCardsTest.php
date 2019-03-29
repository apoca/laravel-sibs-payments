<?php

namespace Apoca\Sibs\Tests\Feature;

use Apoca\Sibs\Facade\Sibs;
use Apoca\Sibs\Tests\TestCase;

/**
 * Class PaymentWithCardsTest
 *
 * @package Apoca\Sibs\Tests\Feature
 */
class PaymentWithCardsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function verifyResponsePaymentCardsSuccess(): void
    {
        $request = [
            'brand' => 'VISA',
            'amount' => 100,
            'currency' => 'EUR',
            'type' => 'DB',
            'number' => 4200000000000000,
            'holder' => 'Jane Jones',
            'expiry_month' => 5,
            'expiry_year' => 2020,
            'cvv' => 123,
        ];

        $response = Sibs::checkout($request)->pay();

        $this->assertSame($response->status, 200);
    }
}
