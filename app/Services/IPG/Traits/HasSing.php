<?php

namespace App\Services\IPG\Traits;

use App\Services\IPG\DTOs\GatewayResponse;

trait HasSing
{
    private GatewayResponse $gatewayResponse;

    /**
     * @return string
     */
    private function getPurchaseSing(): string
    {
        return hash_hmac(
            'SHA512',
            sprintf
            (
                '%s#%s#%s',
                $this->invoice->getAmount(),
                $this->invoice->getUuid(),
                $this->settings['CALLBACK_URL']),
            $this->settings['KEY']
        );
    }

    /**
     * @return string
     */
    public function getVerifySing(): string
    {
        return hash_hmac(
            'SHA512',
            sprintf(
                '%s#%s#%s#%s',
                $this->invoice->getAmount(),
                $this->gatewayResponse->getRefNum(),
                $this->gatewayResponse->getCardNumber(),
                $this->gatewayResponse->getTrackingCode()
            ), $this->settings['KEY']
        );
    }

}