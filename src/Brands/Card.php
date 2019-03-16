<?php

namespace Apoca\Sibs\Brands;

/**
 * Class Card
 *
 * @package Apoca\Sibs\Brands
 */
class Card
{
    /**
     * @var int
     */
    protected $number;

    /**
     * @var string
     */
    protected $holder;

    /**
     * @var int
     */
    protected $expiryMonth;

    /**
     * @var int
     */
    protected $expiryYear;

    /**
     * @var int
     */
    protected $cvv;

    /**
     * Card constructor.
     *
     * @param int    $number
     * @param string $holder
     * @param int    $expiryMonth
     * @param int    $expiryYear
     * @param int    $cvv
     */
    public function __construct(int $number, string $holder, int $expiryMonth, int $expiryYear, int $cvv)
    {
        $this->setNumber($number);
        $this->setHolder($holder);
        $this->setExpiryMonth($expiryMonth);
        $this->setExpiryYear($expiryYear);
        $this->setCvv($cvv);
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getHolder(): string
    {
        return $this->holder;
    }

    /**
     * @param string $holder
     */
    public function setHolder(string $holder): void
    {
        $this->holder = $holder;
    }

    /**
     * @return int
     */
    public function getExpiryMonth(): int
    {
        return $this->expiryMonth;
    }

    /**
     * @param int $expiryMonth
     */
    public function setExpiryMonth(int $expiryMonth): void
    {
        $this->expiryMonth = $expiryMonth;
    }

    /**
     * @return mixed
     */
    public function getExpiryYear(): int
    {
        return $this->expiryYear;
    }

    /**
     * @param int $expiryYear
     */
    public function setExpiryYear(int $expiryYear): void
    {
        $this->expiryYear = $expiryYear;
    }

    /**
     * @return int
     */
    public function getCvv(): int
    {
        return $this->cvv;
    }

    /**
     * @param int $cvv
     */
    public function setCvv(int $cvv): void
    {
        $this->cvv = $cvv;
    }
}