<?php

namespace Apoca\Sibs\Brands;


class PaymentWithMBWay extends Payment
{
    /**
     * @var string
     */
    protected $accountId;

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
     * @param string $accountId
     */
    public function __construct(
        float $amount,
        string $currency,
        string $brand,
        string $type,
        string $accountId
    ) {
        parent::__construct($amount, $currency, $brand, $type);
        $this->accountId = $accountId;
        $this->endpoint = config('sibs.host') . config('sibs.version') . '/';
    }



    public function pay()
    {
        $data = (object)null;

        try {
            $client = new Client($this->clientConfig);

            $payload = [
                'authentication.userId' => config('sibs.authentication.userId'),
                'authentication.password' => config('sibs.authentication.password'),
                'authentication.entityId' => config('sibs.authentication.entityId'),
                'amount' => number_format($this->amount, 2),
                'currency' => $this->currency,
                'paymentBrand' => $this->brand,
                'paymentType' => $this->type,
                'card.number' => $this->card->getNumber(),
                'card.holder' => $this->card->getHolder(),
                'card.expiryMonth' => str_pad($this->card->getExpiryMonth(), 2, '0', STR_PAD_LEFT),
                'card.expiryYear' => $this->card->getExpiryYear(),
                'card.cvv' => $this->card->getCvv(),
            ];

            $response = $client->post($this->endpoint . 'payments', [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
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