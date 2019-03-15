<?php

namespace Apoca\Sibs\Services;

use Apoca\Sibs\Brands\Card;
use Apoca\Sibs\Brands\PaymentInterface;
use Apoca\Sibs\Brands\PaymentWithCard;
use Exception;
use Illuminate\Support\Arr;

/**
 * Class SibsService
 *
 * @package Apoca\Sibs\Services
 */
class SibsService
{
    /**
     * @var array
     */
    protected $brandCards = [
        'VISA',
        'MASTER',
        'AMEX',
        'VPAY',
        'MAESTRO',
        'VISADEBIT',
        'VISAELECTRON',
    ];

    /**
     * @param array $request
     *
     * @return PaymentInterface
     * @throws Exception
     */
    public function checkout(array $request): PaymentInterface
    {
        if (Arr::exists($this->brandCards, strtoupper($request['brand']))) {
            $payment = new PaymentWithCard(
                $request['amount'],
                $request['currency'],
                $request['brand'],
                $request['type'],
                new Card(
                    $request['number'],
                    $request['holder'],
                    $request['expiry_month'],
                    $request['expiry_year'],
                    $request['cvv']
                )
            );
        } elseif (strtoupper($request['brand']) === 'SIBS_MULTIBANCO') {
            throw new \RuntimeException('Service Payment not found.', 404);
        } elseif (strtoupper($request['brand']) === 'DIRECTDEBIT_SEPA') {
            throw new \RuntimeException('Service Payment not found.', 404);
        } elseif (strtoupper($request['brand']) === 'MBWAY') {
            throw new \RuntimeException('Service Payment not found.', 404);
        } else {
            throw new \RuntimeException('Service Payment not found.', 404);
        }

        return $payment;
    }
}
