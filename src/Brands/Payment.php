<?php

namespace Apoca\Sibs\Brands;

use Apoca\Sibs\Contracts\PaymentInterface;

/**
 * Class Payment
 *
 * @package Apoca\Sibs\Brands
 */
abstract class Payment implements PaymentInterface
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
    protected $brand;

    /**
     * @var array
     */
    protected $optionalParameters = [];

    /**
     * @var string
     */
    protected $type;

    /**
     * Payment constructor.
     *
     * @param float  $amount
     * @param string $currency
     * @param string $brand
     * @param string $type
     * @param array  $optionalParameters
     */
    public function __construct(float $amount, string $currency, string $brand, string $type, array $optionalParameters)
    {
        $this->setAmount($amount);
        $this->setCurrency($currency);
        $this->setBrand($brand);
        $this->setType($type);
        $this->setOptionalParameters($optionalParameters);
    }

    /**
     * @return array
     */
    public function getOptionalParameters(): array
    {
        return $this->optionalParameters;
    }

    /**
     * @param array $optionalParameters
     */
    public function setOptionalParameters(array $optionalParameters): void
    {
        $this->optionalParameters = $optionalParameters;
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
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
}
