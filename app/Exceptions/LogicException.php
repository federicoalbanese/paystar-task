<?php

namespace App\Exceptions;

use App\Constants\ErrorConstants;
use Throwable;

/**
 * Class LogicException
 *
 * @package App\Exceptions
 */
class LogicException extends \Exception
{
    /**
     * LogicException constructor.
     *
     * @param integer        $code
     * @param Throwable|null $previous
     */
    public function __construct(int $code = 0, Throwable $previous = null)
    {
        $message = 'Internal server error.';

        if (isset(ErrorConstants::LABELS[$code])) {
            $errorMessage = ErrorConstants::LABELS[$code];
            $message      = __($errorMessage);
        }

        parent::__construct($message, $code, $previous);
    }
}
