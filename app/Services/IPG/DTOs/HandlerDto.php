<?php

namespace App\Services\IPG\DTOs;

use App\Models\Payment;
use App\Models\User;

class HandlerDto
{
    private ?Payment $payment = null;

    private GatewayResponse $gatewayResponse;

    private User $user;

    /**
     * @return \App\Models\Payment|null
     */
    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    /**
     * @param \App\Models\Payment|null $payment
     *
     * @return HandlerDto
     */
    public function setPayment(?Payment $payment): HandlerDto
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * @return \App\Services\IPG\DTOs\GatewayResponse
     */
    public function getGatewayResponse(): GatewayResponse
    {
        return $this->gatewayResponse;
    }

    /**
     * @param \App\Services\IPG\DTOs\GatewayResponse $gatewayResponse
     *
     * @return HandlerDto
     */
    public function setGatewayResponse(GatewayResponse $gatewayResponse): HandlerDto
    {
        $this->gatewayResponse = $gatewayResponse;

        return $this;
    }

    /**
     * @return \App\Models\User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param \App\Models\User $user
     *
     * @return HandlerDto
     */
    public function setUser(User $user): HandlerDto
    {
        $this->user = $user;

        return $this;
    }
}