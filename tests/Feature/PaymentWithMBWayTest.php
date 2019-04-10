<?php
/**
 * Created by PhpStorm.
 * User: esolidar
 * Date: 2019-04-01
 * Time: 15:02
 */

namespace Apoca\Sibs\Tests\Feature;


use Apoca\Sibs\Facade\Sibs;
use Apoca\Sibs\Tests\TestCase;

class PaymentWithMBWayTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function verifyResponsePaymentWithMbwayDefaultTest(): void
    {
        $request = [
            'entityId' => config('sibs.authentication.entityId'),
            'amount' => 10.44,
            'currency' => 'EUR',
            'brand' => 'MBWAY',
            'type' => 'PA',
            'accountId' => '351#911222111',
        ];

        $response = Sibs::checkout($request)->pay();

        $this->assertSame($response->status, 400);
        $this->assertObjectHasAttribute('id', $response->response);
        $this->assertObjectHasAttribute('paymentType', $response->response);
        $this->assertObjectHasAttribute('paymentBrand', $response->response);
        $this->assertObjectHasAttribute('result', $response->response);
        $this->assertObjectHasAttribute('buildNumber', $response->response);
        $this->assertObjectHasAttribute('timestamp', $response->response);
        $this->assertObjectHasAttribute('ndc', $response->response);
    }
}