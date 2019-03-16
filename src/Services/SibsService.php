<?php

namespace Apoca\Sibs\Services;

use Apoca\Sibs\Brands\Card;
use Apoca\Sibs\Brands\PaymentWithCard;
use Apoca\Sibs\Contracts\PaymentInterface;
use Exception;

/**
 * Class SibsService
 *
 * @package Apoca\Sibs\Services
 */
class SibsService
{
    /**
     * @param array $request
     *
     * @return PaymentInterface
     * @throws Exception
     */
    public function checkout(array $request): PaymentInterface
    {
        switch (strtoupper($request['brand'])) {
            case 'VISA' || 'MASTER' || 'AMEX' || 'VPAY' || 'MAESTRO' || 'VISADEBIT' || 'VISAELECTRON':
                $payment = new PaymentWithCard(
                    $request['amount'],
                    strtoupper($request['currency']),
                    strtoupper($request['brand']),
                    strtoupper($request['type']),
                    new Card(
                        $request['number'],
                        $request['holder'],
                        $request['expiry_month'],
                        $request['expiry_year'],
                        $request['cvv']
                    )
                );
                break;
            case 'SIBS_MULTIBANCO':
                throw new \RuntimeException('SIBS_MULTIBANCO Service Payment not found.', 404);
                break;
            case 'DIRECTDEBIT_SEPA':
                throw new \RuntimeException('DIRECTDEBIT_SEPA Service Payment not found.', 404);
                break;
            case 'MBWAY':
                throw new \RuntimeException('MBWAY Service Payment not found.', 404);
                break;
            default:
                throw new \RuntimeException('Sibs Service Payment not found.', 404);
        }

        return $payment;
    }
}
