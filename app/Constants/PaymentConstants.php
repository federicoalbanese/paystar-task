<?php

namespace App\Constants;

class PaymentConstants
{
    const INIT = 'INIT';

    const SUCCESS = 'SUCCESS';

    const FAIL = 'FAIL';

    const STATUSES = [
        self::INIT,
        self::SUCCESS,
        self::FAIL,
    ];
}
