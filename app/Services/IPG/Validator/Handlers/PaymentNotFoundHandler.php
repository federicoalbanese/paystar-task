<?php

namespace App\Services\IPG\Validator\Handlers;

use App\Constants\ErrorConstants;
use App\Services\IPG\DTOs\HandlerDto;

class PaymentNotFoundHandler implements \App\Interfaces\HandlerInterface
{

    /**
     * @param HandlerDto $handlerDto
     *
     * @return bool
     */
    public function handle(HandlerDto $handlerDto): bool
    {
        return ! is_null($handlerDto->getPayment());
    }

    public function getCode(): int
    {
        return ErrorConstants::PAYMENT_NOT_FOUND;
    }
}