<?php

namespace App\Constants;

class ErrorConstants
{
    const UNKNOWN_VALUE = 1000;

    const INVOICE_NOTFOUND = 1001;

    const CARD_NUMBER_NOT_MATCH = 1002;

    const LABELS = [
        self::UNKNOWN_VALUE => 'Amount value should be an integer.',
        self::INVOICE_NOTFOUND => 'Invoice not selected or does not exist.',
        self::CARD_NUMBER_NOT_MATCH => 'card number paying with not match with your card in website.',
    ];
}
