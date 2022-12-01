<?php

namespace App\Services\IPG\Validator;

use App\Abstracts\AbstractBaseHandler;
use App\Interfaces\HandlerInterface;
use App\Services\IPG\Validator\Handlers\PaymentNotFoundHandler;

class PaymentValidator extends AbstractBaseHandler
{

    /**
     * @return integer|null
     */
    public function build(): ?int
    {
        /** @var HandlerInterface $item */
        foreach (static::getHandlers() as $item) {
            if (! $item->handle()) {
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