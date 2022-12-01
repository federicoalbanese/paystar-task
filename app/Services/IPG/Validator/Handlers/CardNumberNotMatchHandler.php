<?php

namespace App\Services\IPG\Validator\Handlers;

use App\Constants\ErrorConstants;
use App\Interfaces\HandlerInterface;
use App\Services\IPG\DTOs\HandlerDto;

class CardNumberNotMatchHandler implements HandlerInterface
{
    /**
     * @param HandlerDto $handlerDto
     *
     * @return bool
     */
    public function handle(HandlerDto $handlerDto): bool
    {
        return $handlerDto->getGatewayResponse()->hasSameCard($handlerDto->getUser()->getCardNumber());
    }

    public function getCode(): int
    {
        return ErrorConstants::CARD_NUMBER_NOT_MATCH;
    }
}