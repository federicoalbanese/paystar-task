<?php

namespace App\Services\IPG\DTOs;

use App\Constants\ErrorConstants;
use App\Exceptions\LogicException;
use Ramsey\Uuid\Uuid;

class Invoice
{
    protected string $uuid;

    protected int $amount = 0;

    protected string $referenceId;

    protected string $token;

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
     */
    public function setAmount(int $amount): Invoice
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string
     */
    public function getReferenceId(): string
    {
        return $this->referenceId;
    }

    /**
     * @param string $referenceId
     *
     * @return Invoice
     */
    public function setReferenceId(string $referenceId): Invoice
    {
        $this->referenceId = $referenceId;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     *
     * @return Invoice
     */
    public function setToken(string $token): Invoice
    {
        $this->token = $token;

        return $this;
    }
}
