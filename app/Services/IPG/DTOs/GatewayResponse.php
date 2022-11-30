<?php

namespace App\Services\IPG\DTOs;

use App\Services\IPG\Abstracts\AbstractBaseDTO;

class GatewayResponse extends AbstractBaseDTO
{
    private int $status;

    private string $orderId;

    private string $refNum;

    private string $transactionId;

    private ?string $cardNumber = null;

    private ?string $trackingCode = null;

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return GatewayResponse
     */
    public function setStatus(int $status): GatewayResponse
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     *
     * @return GatewayResponse
     */
    public function setOrderId(string $orderId): GatewayResponse
    {
        $this->orderId = $orderId;

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
     * @return GatewayResponse
     */
    public function setRefNum(string $refNum): GatewayResponse
    {
        $this->refNum = $refNum;

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
     * @return GatewayResponse
     */
    public function setTransactionId(string $transactionId): GatewayResponse
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    /**
     * @param string|null $cardNumber
     *
     * @return GatewayResponse
     */
    public function setCardNumber(?string $cardNumber): GatewayResponse
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTrackingCode(): ?string
    {
        return $this->trackingCode;
    }

    /**
     * @param string|null $trackingCode
     *
     * @return GatewayResponse
     */
    public function setTrackingCode(?string $trackingCode): GatewayResponse
    {
        $this->trackingCode = $trackingCode;

        return $this;
    }
}