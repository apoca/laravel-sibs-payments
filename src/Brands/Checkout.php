<?php

namespace Apoca\Sibs\Brands;

use Apoca\Sibs\Contracts\PaymentInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Class Checkout
 *
 * @package Apoca\Sibs\Brands
 */
class Checkout implements PaymentInterface
{
    /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var string
     */
    protected $paymentType = 'DB';

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var array
     */
    protected $clientConfig = [];

    /**
     * Checkout constructor.
     *
     * @param float  $amount
     * @param string $currency
     * @param string $paymentType
     */
    public function __construct(float $amount, string $currency, string $paymentType)
    {
        $this->setAmount($amount);
        $this->setCurrency($currency);
        $this->setPaymentType($paymentType);

        if (config('sibs.mode') === 'test') {
            $this->clientConfig = [
                'verify' => false,
            ];
        }
        $this->endpoint = config('sibs.host') . config('sibs.version') . '/';
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getPaymentType(): string
    {
        return $this->paymentType;
    }

    /**
     * @param string $paymentType
     */
    public function setPaymentType(string $paymentType): void
    {
        $this->paymentType = $paymentType;
    }

    /**
     * @return object
     */
    public function pay(): object
    {
        $data = (object)null;

        try {
            $client = new Client($this->clientConfig);

            $payload = [
                'entityId' => config('sibs.authentication.entityId'),
                'amount' => number_format($this->amount, 2),
                'currency' => $this->currency,
                'paymentType' => $this->paymentType,
            ];

            $response = $client->post($this->endpoint . 'checkouts', [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Content-Length' => ob_get_length(),
                    'Authorization' => config('sibs.authentication.token'),
                ],
                'form_params' => $payload,
            ]);

            $data->status = $response->getStatusCode();
            $data->response = json_decode($response->getBody()->getContents());

            return $data;
        } catch (ClientException $e) {
            $response = $e->getResponse();

            $data->status = $response->getStatusCode();
            $data->response = json_decode($response->getBody()->getContents());

            return $data;
        }
    }
}
