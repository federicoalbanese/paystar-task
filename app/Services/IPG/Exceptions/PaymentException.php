<?php

namespace App\Services\IPG\Exceptions;

use App\Constants\ErrorConstants;
use App\Constants\PaymentConstants;
use Throwable;

class PaymentException extends \Exception
{
    /**
     * LogicException constructor.
     *
     * @param integer        $code
     * @param Throwable|null $previous
     */
    public function __construct(int $code = 0, Throwable $previous = null)
    {
        $message = 'An unknown error has occurred.';

        if (isset(PaymentConstants::RESPONSE_STATUSES[$code])) {
            $errorMessage = PaymentConstants::RESPONSE_STATUSES[$code];
            $message = __($errorMessage);
        }

        parent::__construct($message, $code, $previous);
    }
}