<?php

namespace App\Interfaces;

use App\Services\IPG\DTOs\GatewayResponse;

interface PaymentInterface
{
    public function purchase();

    public function pay();

    public function verify(GatewayResponse $gatewayResponse);
}
