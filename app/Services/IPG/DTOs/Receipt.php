<?php

namespace App\Services\IPG\DTOs;

use App\Services\IPG\Abstracts\AbstractBaseDTO;
use Carbon\Carbon;

class Receipt extends AbstractBaseDTO
{
    private int $price;

    private string $refNum;

    private string $cardNumber;

    private Carbon $date;

    private string $message = '';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setDate();
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     *
     * @return Receipt
     */
    public function setPrice(int $price): Receipt
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string
     */
    public function getRefNum(): string
    {
        return $this->refNum;
    }

    /**
     * @param string $refNum
     *
     * @return Receipt
     */
    public function setRefNum(string $refNum): Receipt
    {
        $this->refNum = $refNum;

        return $this;
    }

    /**
     * @return string
     */
    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    /**
     * @param string $cardNumber
     *
     * @return Receipt
     */
    public function setCardNumber(string $cardNumber): Receipt
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * @return \Carbon\Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }

    private function setDate()
    {
        $this->date = Carbon::now();
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return Receipt
     */
    public function setMessage(string $message): Receipt
    {
        $this->message = $message;

        return $this;
    }
}