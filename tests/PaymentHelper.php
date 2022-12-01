<?php

namespace Tests;

use App\Services\IPG\DTOs\Invoice;

trait PaymentHelper
{
    public string $successMessage = 'ok';

    public int $successStatus = 1;

    public string $successToken = 'test-1';

    public string $successRefNum = 'test';

    public string $orderId = '1234-123-145535';

    public int $paymentAmount = 5000;

    public string $failMessage = 'shop gateway is not active';

    public int $failStatus = -2;

    public string $failToken = '';

    public string $failRefNum = '';

    /**
     * @return array
     */
    public function getSuccessData(): array
    {
        return [
            'status' => $this->successStatus,
            'message' => $this->successMessage,
            'data' => [
                'token' => $this->successToken,
                'ref_num' => $this->successRefNum,
                'order_id' => $this->orderId,
                'payment_amount' => $this->paymentAmount,
            ],
        ];
    }

    /**
     * @return array
     */
    public function getFailData(): array
    {
        return [
            'status' => $this->failStatus,
            'message' => $this->failMessage,
            'data' => [
                'token' => $this->failToken,
                'ref_num' => $this->failRefNum,
                'order_id' => $this->orderId,
                'payment_amount' => $this->paymentAmount,
            ],
        ];
    }

    /**
     * @return Invoice
     */
    public function getInvoice(): Invoice
    {
        return (new Invoice())
            ->setAmount($this->paymentAmount);
    }

    /**
     * @return string
     */
    public function getRedirectUrl(): string
    {
        return sprintf(config('payment.PAYMENT_URI') . "?token=%s", $this->successToken);
    }
}