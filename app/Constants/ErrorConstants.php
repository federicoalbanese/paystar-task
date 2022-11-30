<?php

namespace App\Constants;

class ErrorConstants
{
    const UNKNOWN_VALUE = 1000;

    const INVOICE_NOTFOUND = 1001;

    const LABELS = [
        self::UNKNOWN_VALUE => 'Amount value should be an integer.',
        self::INVOICE_NOTFOUND => 'Invoice not selected or does not exist.',
    ];
}
