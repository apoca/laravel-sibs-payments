<?php

namespace Apoca\Sibs\Tests\Unit;

use Apoca\Sibs\Brands\PaymentWithCard;
use Apoca\Sibs\Contracts\PaymentInterface;
use Apoca\Sibs\Tests\TestCase;
use Mockery as m;

/**
 * Class PaymentWithCardsTest
 *
 * @property PaymentWithCard|m\MockInterface paymentCards
 * @package Apoca\Sibs\Tests\Unit
 */
class PaymentWithCardsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->paymentCards = m::mock(PaymentWithCard::class);
    }

    /**
     * @test
     */
    public function paymentCardsImplementsPaymentInterface(): void
    {
        $this->assertInstanceOf(PaymentInterface::class, $this->paymentCards);
    }
}
