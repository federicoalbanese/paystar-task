<?php

namespace App\Constants;

class PaymentConstants
{
    const INIT = 'INIT';

    const SUCCESS = 'SUCCESS';

    const FAIL = 'FAIL';

    const GET = 'GET';

    const POST = 'POST';

    const HTTP_TYPES = [
        self::GET => 1,
        self::POST => 0,
    ];

    const STATUSES = [
        self::INIT,
        self::SUCCESS,
        self::FAIL,
    ];
}
