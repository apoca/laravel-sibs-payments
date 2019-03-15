<?php

namespace Apoca\Sibs\Brands;

use GuzzleHttp\Client;

/**
 * Class PaymentWithCard
 *
 * @package Apoca\Sibs\Brands
 */
class PaymentWithCard extends Payment
{
    /**
     * @var Card
     */
    protected $card;

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var array
     */
    protected $clientConfig = [];

    /**
     * PaymentWithCard constructor.
     *
     * @param float  $amount
     * @param string $currency
     * @param string $brand
     * @param string $type
     * @param Card   $card
     */
    public function __construct(
        float $amount,
        string $currency,
        string $brand,
        string $type,
        Card $card
    ) {
        parent::__construct($amount, $currency, $brand, $type);
        $this->card = $card;

        if (config('sibs.mode') === 'test') {
            $this->clientConfig = [
                'verify' => false,
            ];
        }
        $this->endpoint = config('sibs.host') . config('sibs.version');
    }

    public function pay()
    {
        $client = new Client($this->clientConfig);

        $response = $client->post($this->endpoint . 'payments', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'body' => json_encode([
                'authentication.userId' => config('sibs.authentication.userId'),
                'authentication.password' => config('sibs.authentication.password'),
                'authentication.entityId' => config('sibs.authentication.entityId'),
                'amount' => $this->amount,
                'currency' => $this->currency,
                'paymentBrand' => $this->brand,
                'paymentType' => $this->type,
                'card.number' => $this->card->getNumber(),
                'card.holder' => $this->card->getHolder(),
                'card.expiryMonth' => $this->card->getExpiryMonth(),
                'card.expiryYear' => $this->card->getExpiryYear(),
                'card.cvv' => $this->card->getCvv(),
            ]),
        ]);

        print_r($response);
    }
}
