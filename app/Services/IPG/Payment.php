<?php

namespace App\Services\IPG;

use App\Constants\PaymentConstants;
use App\Interfaces\PaymentInterface;
use App\Services\IPG\DTOs\GatewayResponse;
use App\Services\IPG\DTOs\Invoice;
use App\Services\IPG\DTOs\Receipt;
use App\Services\IPG\Exceptions\PurchaseFailedException;
use App\Services\IPG\Traits\HasDetails;
use App\Services\IPG\Traits\HasSing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;

class Payment implements PaymentInterface
{
    use HasSing, HasDetails;

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
            'sign' => $this->getPurchaseSing(),
            'callback_method' => PaymentConstants::HTTP_TYPES[$this->settings['CALLBACK_METHOD']],
        ];
        $response = Http::withHeaders($this->getHeaders())
            ->post('https://core.paystar.ir/api/pardakht/create', $postFields);

        $body = json_decode($response->body(), true);

        $this->checkResponse($body['status']);
        $this->invoice->setTransactionId($body['data']['ref_num']);
        $this->invoice->setToken($body['data']['token']);

        return $this->invoice;
    }

    /**
     * @return RedirectResponse
     */
    public function pay(): RedirectResponse
    {
        return redirect()->away($this->getRedirectUrl());
    }

    /**
     * @param GatewayResponse $gatewayResponse
     *
     * @return Receipt
     * @throws PurchaseFailedException
     */
    public function verify(GatewayResponse $gatewayResponse): Receipt
    {
        $this->gatewayResponse = $gatewayResponse;

        $postFields = [
            'ref_num' => $gatewayResponse->getRefNum(),
            'amount' => $this->invoice->getAmount(),
            'sign' => $this->getVerifySing(),
        ];

        $response = Http::withHeaders($this->getHeaders())
            ->post('https://core.paystar.ir/api/pardakht/verify', $postFields);
        $body = json_decode($response->body(), true);

        $this->checkResponse($body['status']);

        return $this->generateReceipt($body);
    }

    /**
     * @param integer $status
     *
     * @throws PurchaseFailedException
     */
    public function checkResponse(int $status): void
    {
        if ($status !== PaymentConstants::RESPONSE_STATUS_OK) {
            throw new PurchaseFailedException($status);
        }
    }

    /**
     * @param array $verifyResponse
     *
     * @return Receipt
     */
    private function generateReceipt(array $verifyResponse): Receipt
    {
        return new Receipt($verifyResponse['data']);
    }
}
