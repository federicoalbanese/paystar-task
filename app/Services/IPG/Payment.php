<?php

namespace App\Services\IPG;

use App\Constants\PaymentConstants;
use App\Interfaces\PaymentInterface;
use App\Services\IPG\Exceptions\PurchaseFailedException;
use Illuminate\Support\Facades\Http;

class Payment implements PaymentInterface
{

    private Invoice $invoice;

    private array $settings;

    public function __construct(Invoice $invoice, array $settings)
    {
        $this->settings = $settings;
        $this->invoice = $invoice;
    }

    /**
     * @return string
     * @throws PurchaseFailedException
     */
    public function purchase(): string
    {
        $postFields = [
            'amount' => $this->invoice->getAmount(),
            'order_id' => $this->invoice->getUuid(),
            'callback' => $this->settings['CALLBACK_URL'],
            'sign' => $this->getSing(),
            'callback_method' => PaymentConstants::HTTP_TYPES[$this->settings['CALLBACK_METHOD']],
        ];

        $terminalId = $this->settings['TERMINAL_ID'];

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $terminalId",
        ];

        $response = Http::withHeaders($headers)
            ->post('https://core.paystar.ir/api/pardakht/create', $postFields);

        $body = json_decode($response->body(), true);

        if ($body['status'] !== 1) {
            throw new PurchaseFailedException();
        }
        $this->invoice->setTransactionId($body['data']['ref_num']);

        return $this->invoice->getTransactionId();
    }

    public function pay()
    {
    }

    public function verify()
    {
    }

    /**
     * @return string
     */
    private function getSing(): string
    {
        return hash_hmac('SHA512',
            sprintf
            (
                '%s#%s#%s',
                $this->invoice->getAmount(),
                $this->invoice->getUuid(),
                $this->settings['CALLBACK_URL']),
            $this->settings['KEY']
        );
    }
}
