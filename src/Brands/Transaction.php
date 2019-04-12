<?php

namespace Apoca\Sibs\Brands;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Class Transaction
 *
 * @package Apoca\Sibs\Brands
 */
class Transaction
{
    /**
     * @var string
     */
    protected $checkoutId;

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var array
     */
    protected $clientConfig = [];

    /**
     * Transaction constructor.
     *
     * @param string $checkoutId
     */
    public function __construct(string $checkoutId)
    {
        $this->setCheckoutId($checkoutId);

        if (config('sibs.mode') === 'test') {
            $this->clientConfig = [
                'verify' => false,
            ];
        }
        $this->endpoint = config('sibs.host') . config('sibs.version') . '/';
    }

    /**
     * @return string
     */
    public function getCheckoutId(): string
    {
        return $this->checkoutId;
    }

    /**
     * @param mixed $checkoutId
     */
    public function setCheckoutId($checkoutId): void
    {
        $this->checkoutId = $checkoutId;
    }

    /**
     * Get status payment
     *
     * @return object
     */
    public function status(): object
    {
        $data = (object)null;

        try {
            $client = new Client($this->clientConfig);

            $response = $client->get($this->endpoint . "checkouts/{$this->getCheckoutId()}/payment?entityId=" . config('sibs.authentication.entityId'),
                [
                    'headers' => [
                        'Authorization' => config('sibs.authentication.token'),
                    ],
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
