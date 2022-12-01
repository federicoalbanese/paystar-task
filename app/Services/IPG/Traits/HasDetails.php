<?php

namespace App\Services\IPG\Traits;

trait HasDetails
{
    /**
     * @return string
     */
    public function getRedirectUrl(): string
    {
        return sprintf('%s?token=%s', $this->settings['PAYMENT_URI'], $this->invoice->getToken());
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => sprintf("Bearer %s", $this->settings['TERMINAL_ID']),
        ];
    }
}