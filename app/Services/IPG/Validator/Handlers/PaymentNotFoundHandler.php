<?php

namespace App\Services\IPG\Validator\Handlers;

use App\Constants\ErrorConstants;

class PaymentNotFoundHandler implements \App\Interfaces\HandlerInterface
{

    public function handle()
    {

    }

    public function getCode(): int
    {
        return ErrorConstants::PAYMENT_NOT_FOUND;
    }
}