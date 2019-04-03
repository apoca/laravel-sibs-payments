<?php

namespace Apoca\Sibs\Tests\Unit;

use Apoca\Sibs\Brands\Checkout;
use Apoca\Sibs\Contracts\PaymentInterface;
use Apoca\Sibs\Tests\TestCase;
use Mockery as m;

/**
 * Class CheckoutTest
 *
 * @property m\MockInterface checkout
 * @package Apoca\Sibs\Tests\Unit
 */
class CheckoutTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->checkout = m::mock(Checkout::class);
    }

    /**
     * @test
     */
    public function checkoutImplementsPaymentInterfaceTest(): void
    {
        $this->assertInstanceOf(PaymentInterface::class, $this->checkout);
    }
}
