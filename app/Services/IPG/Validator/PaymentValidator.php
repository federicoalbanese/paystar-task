<?php

namespace App\Services\IPG\Validator;

use App\Abstracts\AbstractBaseHandler;
use App\Interfaces\HandlerInterface;
use App\Services\IPG\DTOs\HandlerDto;
use App\Services\IPG\Validator\Handlers\PaymentNotFoundHandler;

class PaymentValidator extends AbstractBaseHandler
{

    /**
     * @return integer|null
     */
    public static function build(HandlerDto $handlerDto): ?int
    {
        /** @var HandlerInterface $item */
        foreach (static::getHandlers() as $item) {
            if (! $item->handle($handlerDto)) {
                return $item->getCode();
            }
        }

        return null;
    }

    protected static function getRawHandlers(): array
    {
        return [
            PaymentNotFoundHandler::class,
        ];
    }
}