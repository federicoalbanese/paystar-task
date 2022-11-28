<?php

namespace App\Services\IPG;

use App\Constants\ErrorConstants;
use App\Exceptions\LogicException;
use Ramsey\Uuid\Uuid;

class Invoice
{
    protected string $uuid;

    protected int $amount = 0;

    protected string $transactionId;

    public function __construct()
    {
        $this->generateUuid();
    }

    public function generateUuid()
    {
        if (empty($uuid)) {
            $uuid = Uuid::uuid4()->toString();
        }

        $this->setUuid($uuid);
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     *
     * @return Invoice
     */
    public function setUuid(string $uuid): Invoice
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     *
     * @return $this
     * @throws \App\Exceptions\LogicException
     */
    public function setAmount(int $amount): Invoice
    {
        if (!is_int($amount)) {
            throw new LogicException(ErrorConstants::UNKNOWN_VALUE);
        }
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     *
     * @return Invoice
     */
    public function setTransactionId(string $transactionId): Invoice
    {
        $this->transactionId = $transactionId;

        return $this;
    }
}
