<?php

namespace App\Constants;

class PaymentConstants
{
    const INIT = 'INIT';

    const SUCCESS = 'SUCCESS';

    const FAIL = 'FAIL';

    const GET = 'GET';

    const POST = 'POST';

    const RESPONSE_STATUS_OK = 1;

    const RESPONSE_STATUS_INVALID_REQUEST = -1;

    const RESPONSE_STATUS_INACTIVE_GATEWAY = -2;

    const RESPONSE_STATUS_RETRY_TOKEN = -3;

    const RESPONSE_STATUS_AMOUNT_LIMIT_EXCEED = -4;

    const RESPONSE_STATUS_INVALID_REF_NUM = -5;

    const RESPONSE_STATUS_RETRY_VERIFICATION = -6;

    const RESPONSE_STATUS_BAD_DATA = -7;

    const RESPONSE_STATUS_TR_NOT_VERIFIABLE = -8;

    const RESPONSE_STATUS_TR_NOT_VERIFIED = -9;

    const RESPONSE_STATUS_PAYMENT_FAILED = -98;

    const RESPONSE_STATUS_ERROR = -99;

    const RESPONSE_STATUSES = [
        self::RESPONSE_STATUS_OK => 'successful',
        self::RESPONSE_STATUS_INVALID_REQUEST => 'invalid request',
        self::RESPONSE_STATUS_INACTIVE_GATEWAY => 'shop gateway is not active',
        self::RESPONSE_STATUS_RETRY_TOKEN => 'the token is duplicated',
        self::RESPONSE_STATUS_AMOUNT_LIMIT_EXCEED => 'the amount is more than the permissible limit of the gateway',
        self::RESPONSE_STATUS_INVALID_REF_NUM => 'identifier ref_num is not valid',
        self::RESPONSE_STATUS_RETRY_VERIFICATION => 'the transaction has already been verified',
        self::RESPONSE_STATUS_BAD_DATA => 'the parameters passed are invalid',
        self::RESPONSE_STATUS_TR_NOT_VERIFIABLE => 'the transaction cannot be verified',
        self::RESPONSE_STATUS_TR_NOT_VERIFIED => 'the transaction could not be verified',
        self::RESPONSE_STATUS_PAYMENT_FAILED => 'transaction failed',
        self::RESPONSE_STATUS_ERROR => 'system error',
    ];

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
