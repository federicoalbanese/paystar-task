<?php

namespace App\Constants;

class InvoiceConstants
{
    const INIT = 'INIT';
    const SUCCESS = 'SUCCESS';
    const FAIL = 'FAIL';

    const STATUSES = [
        self::INIT,
        self::SUCCESS,
        self::FAIL
    ];
}
