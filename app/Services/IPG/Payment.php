<?php

namespace App\Services\IPG;

use App\Constants\ErrorConstants;
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
     * @return Invoice
     * @throws PurchaseFailedException
     */
    public function purchase(): Invoice
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

        $status = $body['status'];
        if ($status !== PaymentConstants::RESPONSE_STATUS_OK) {
            throw new PurchaseFailedException($this->translateStatus($status));
        }
        $this->invoice->setTransactionId($body['data']['ref_num']);
        $this->invoice->setToken($body['data']['token']);

        return $this->invoice;
    }

    public function pay()
    {
        $paymentUri = $this->settings['PAYMENT_URI'];

        return redirect()->away($paymentUri . '?token=' . $this->invoice->getToken());
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

    /**
     * @param int $status
     *
     * @return int|string
     */
    private function translateStatus(int $status): int|string
    {
        return array_key_exists($status, PaymentConstants::RESPONSE_STATUSES)
            ? PaymentConstants::RESPONSE_STATUSES[$status]
            : ErrorConstants::UNKNOWN_ERROR;
    }
}
